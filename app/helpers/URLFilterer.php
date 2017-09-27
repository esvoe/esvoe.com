<?php

namespace App\Helpers;

class URLFilterer
{
    public static function urlFilter(string $text) {
        $original = $text;
        // Tags to skip and not recurse into.
        $ignore_tags = 'a|script|style|code|pre';
    
        // Create an array which contains the regexps for each type of link.
        // The key to the regexp is the name of a function that is used as
        // callback function to process matches of the regexp. The callback function
        // is to return the replacement for the match. The array is used and
        // matching/replacement done below inside some loops.
        $tasks = [];

        // Prepare protocols pattern for absolute URLs.
        // check_url() will replace any bad protocols with HTTP, so we need to support
        // the identical list. While '//' is technically optional for MAILTO only,
        // we cannot cleanly differ between protocols here without hard-coding MAILTO,
        // so '//' is optional for all protocols.
        // @see filter_xss_bad_protocol()
        $protocols = config('urlfilterer.allowed_protocols', ['ftp', 'http', 'https', 'irc',
            'mailto', 'news', 'nntp', 'rtsp', 'sftp', 'ssh', 'tel', 'telnet', 'webcal']);
        //dd($protocols);
        $protocols = implode(':(?://)?|', $protocols) . ':(?://)?';

        // Prepare domain name pattern.
        // The ICANN seems to be on track towards accepting more diverse top level
        // domains, so this pattern has been "future-proofed" to allow for TLDs
        // of length 2-64.
        $domain = '(?:[A-Za-z0-9._+-]+\.)?[A-Za-z]{2,64}\b';
        $ip = '(?:[0-9]{1,3}\.){3}[0-9]{1,3}';
        $auth = '[a-zA-Z0-9:%_+*~#?&=.,/;-]+@';
        $trail = '[a-zA-Z0-9:%_+*~#&\[\]=/;?!\.,-]*[a-zA-Z0-9:%_+*~#&\[\]=/;-]';

        // Prepare pattern for optional trailing punctuation.
        // Even these characters could have a valid meaning for the URL, such usage is
        // rare compared to using a URL at the end of or within a sentence, so these
        // trailing characters are optionally excluded.
        $punctuation = '[\.,?!]*?';

        // Match absolute URLs.
        $url_pattern = "(?:$auth)?(?:$domain|$ip)/?(?:$trail)?";
        $pattern = "`((?:$protocols)(?:$url_pattern))($punctuation)`";
        $tasks['self::filter_url_parse_full_links'] = $pattern;

        
        // Match e-mail addresses.
        $url_pattern = "[A-Za-z0-9._+-]{1,254}@(?:$domain)";
        $pattern = "`($url_pattern)`";
        $tasks['self::filter_url_parse_email_links'] = $pattern;
        

        // Match www domains.
        $url_pattern = "www\.(?:$domain)/?(?:$trail)?";
        $pattern = "`($url_pattern)($punctuation)`";
        $tasks['self::filter_url_parse_partial_links'] = $pattern;

        // Each type of URL needs to be processed separately. The text is joined and
        // re-split after each task, since all injected HTML tags must be correctly
        // protected before the next task.
        $textsteps = [];
        $t = 0;
        foreach ($tasks as $task => $pattern) {
            // HTML comments need to be handled separately, as they may contain HTML
            // markup, especially a '>'. Therefore, remove all comment contents and add
            // them back later.
            $textsteps[$t][] = $text;
            //$text = self::filter_url_escape_comments('', TRUE);
            $textsteps[$t][] = $text;
            $text = preg_replace_callback('`<!--(.*?)-->`s', 'self::filter_url_escape_comments', $text);
            $textsteps[$t][] = $text;
            // Split at all tags; ensures that no tags or attributes are processed.
            $chunks = preg_split('/(<.+?>)/is', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
            $textsteps[$t]['chunks'][] = $chunks;
            // PHP ensures that the array consists of alternating delimiters and
            // literals, and begins and ends with a literal (inserting NULL as
            // required). Therefore, the first chunk is always text:
            $chunk_type = 'text';
            // If a tag of $ignore_tags is found, it is stored in $open_tag and only
            // removed when the closing tag is found. Until the closing tag is found,
            // no replacements are made.
            $open_tag = '';

            for ($i = 0; $i < count($chunks); $i++) {
              if ($chunk_type == 'text') {
                // Only process this text if there are no unclosed $ignore_tags.
                if ($open_tag == '') {
                  // If there is a match, inject a link into this chunk via the callback
                  // function contained in $task.
                  $chunks[$i] = preg_replace_callback($pattern, $task, $chunks[$i]);
                }
                // Text chunk is done, so next chunk must be a tag.
                $chunk_type = 'tag';
              }
              else {
                // Only process this tag if there are no unclosed $ignore_tags.
                if ($open_tag == '') {
                  // Check whether this tag is contained in $ignore_tags.
                  if (preg_match("`<($ignore_tags)(?:\s|>)`i", $chunks[$i], $matches)) {
                    $open_tag = $matches[1];
                  }
                }
                // Otherwise, check whether this is the closing tag for $open_tag.
                else {
                  if (preg_match("`<\/$open_tag>`i", $chunks[$i], $matches)) {
                    $open_tag = '';
                  }
                }
                // Tag chunk is done, so next chunk must be text.
                $chunk_type = 'text';
              }
            }

            $text = implode($chunks);
            $textsteps[$t][] = $text;
            // Revert back to the original comment contents
            // $text = self::filter_url_escape_comments('', FALSE);
            $textsteps[$t][] = $text;
            $text = preg_replace_callback('`<!--(.*?)-->`', 'self::filter_url_escape_comments', $text);
            $textsteps[$t][] = $text;
            $t++;
        }
        return $text;
    }

    private static function filter_url_trim($text, $length = NULL) {
        static $_length;
        if ($length !== NULL) {
            $_length = $length;
        }

        // Use +3 for '...' string length.
        if ($_length && strlen($text) > $_length + 3) {
            $text = substr($text, 0, $_length) . '...';
        }

        return $text;
    }

    private static function filter_url_parse_full_links($match) {
        // The $i:th parenthesis in the regexp contains the URL.
        $i = 1;
        $match[$i] = html_entity_decode($match[$i], ENT_QUOTES, 'UTF-8');
        $caption = htmlspecialchars($match[$i], ENT_QUOTES, 'UTF-8');
        $match[$i] = htmlspecialchars($match[$i], ENT_QUOTES, 'UTF-8');
        return '<a class="urlfiltered link" href="' . $match[$i] . '">' . $caption . '</a>' . $match[$i + 1];
    }

    private static function filter_url_parse_email_links($match) {
        // The $i:th parenthesis in the regexp contains the URL.
        $i = 0;

        $match[$i] = html_entity_decode($match[$i], ENT_QUOTES, 'UTF-8');
        $caption = htmlspecialchars($match[$i], ENT_QUOTES, 'UTF-8');
        $match[$i] = htmlspecialchars($match[$i], ENT_QUOTES, 'UTF-8');
        return '<a class="urlfiltered mail" href="mailto:' . $match[$i] . '">' . $caption . '</a>';
    }

    private static function filter_url_parse_partial_links($match) {
        $i = 1;
        $match[$i] = html_entity_decode($match[$i], ENT_QUOTES, 'UTF-8');
        $caption = htmlspecialchars($match[$i], ENT_QUOTES, 'UTF-8');
        $match[$i] = htmlspecialchars($match[$i], ENT_QUOTES, 'UTF-8');
        return '<a class="urlfiltered link" href="https://' . $match[$i] . '">' . $caption . '</a>' . $match[$i + 1];
    }

    private static function filter_url_escape_comments($match, $escape = NULL) {
        static $mode, $comments = [];

        if (isset($escape)) {
            $mode = $escape;
            if ($escape) {
                $comments = [];
            }
            return;
        }

        // Replace all HTML coments with a '<!-- [hash] -->' placeholder.
        if ($mode) {
            $content = $match[1];
            $hash = md5($content);
            $comments[$hash] = $content;
            return "<!-- $hash -->";
        }
        // Or replace placeholders with actual comment contents.
        else {
            $hash = $match[1];
            $hash = trim($hash);
            $content = $comments[$hash];
            return "<!--$content-->";
        }
    }
}