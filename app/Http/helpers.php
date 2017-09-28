<?php

function trendingTags()
{
    $trending_tags = App\Hashtag::orderBy('count', 'desc')->get();

    if (count($trending_tags) > 0) {
        if (count($trending_tags) > (int) Setting::get('min_items_page', 3)) {
            $trending_tags = $trending_tags->random((int) Setting::get('min_items_page', 3));
        }
    } else {
        $trending_tags = '';
    }

    return $trending_tags;
}

function suggestedUsers()
{
    $suggested_users = App\User::whereNotIn('id', Auth::user()->following()->get()->pluck('id'))->where('id', '!=', Auth::user()->id)->get();

    if (count($suggested_users) > 0) {
        if (count($suggested_users) > (int) Setting::get('min_items_page', 3)) {
            $suggested_users = $suggested_users->random((int) Setting::get('min_items_page', 3));
        }
    } else {
        $suggested_users = '';
    }

    return $suggested_users;
}

function suggestedGroups()
{
    $suggested_groups = '';
    $suggested_groups = App\Group::whereNotIn('id', Auth::user()->groups()->pluck('group_id'))->where('type', 'open')->get();

    if (count($suggested_groups) > 0) {
        if (count($suggested_groups) > (int) Setting::get('min_items_page', 3)) {
            $suggested_groups = $suggested_groups->random((int) Setting::get('min_items_page', 3));
        }
    } else {
        $suggested_groups = '';
    }

    return $suggested_groups;
}

function suggestedPages()
{
    $suggested_pages = '';
    $suggested_pages = App\Page::whereNotIn('id', Auth::user()->pageLikes()->pluck('page_id'))->whereNotIn('id', Auth::user()->pages()->pluck('page_id'))->get();

    if (count($suggested_pages) > 0) {
        if (count($suggested_pages) > (int) Setting::get('min_items_page', 3)) {
            $suggested_pages = $suggested_pages->random((int) Setting::get('min_items_page', 3));
        }
    } else {
        $suggested_pages = '';
    }

    return $suggested_pages;
}

function verifiedBadge($timeline)
{
    $code = '<span class="verified-badge bg-success">
                    <i class="fa fa-check"></i>
                </span>';
    if($timeline->type == 'user')
    {
        if($timeline->user->verified)
        {
            $result = $code;
        }
        else
        {
            $result = false;
        }
    }
    elseif($timeline->type == 'page')
    {
        if($timeline->page->verified)
        {
            $result = $code;
        }
        else
        {
            $result = false;
        }
    }
    else
    {
        $result = false;
    }
    return $result;
}

//Склоняет слова к числу
//declension(11, array(год, года, лет), false)
//1 - параметр это число
//2 - массив со склоняемым текстом
//3 - true=вернуть текст с числом; false=вернуть текст без числа;

function declension($digit, $expr, $onlyword = false)
{
    if (!is_array($expr)) $expr = array_filter(explode(' ', $expr));
    if (empty($expr[2])) $expr[2] = $expr[1];
    $i = preg_replace('/[^0-9]+/s', '', $digit) % 100;
    if ($onlyword) $digit = '';
    if ($i >= 5 && $i <= 20) {
        $res = $digit . ' ' . $expr[2];
    } else {
        $i %= 10;
        if ($i == 1) $res = $digit . ' ' . $expr[0];
        elseif ($i >= 2 && $i <= 4) $res = $digit . ' ' . $expr[1];
        else $res = $digit . ' ' . $expr[2];
    }
    return trim($res);
}

function LOCAL_DEV_MODE() {
    return $_SERVER['SERVER_ADDR'] == '127.0.0.1';
}

function static_uploads($filePathName) {
    if (LOCAL_DEV_MODE()) {
        return '//'.'static.'.$_SERVER['SERVER_NAME'].'/'.$filePathName;
    }
    return 'https://static.esvoe.com/'.$filePathName;
}

