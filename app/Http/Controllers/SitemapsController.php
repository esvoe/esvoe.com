<?php
namespace App\Http\Controllers;

use App\Page;
use App\Post;
use App\Timeline;
use App\User;
use Sitemap;

class SitemapsController extends Controller
{
    public function index()
    {
//        self::posts();
        self::allTimelines();
        
        return Sitemap::render();
    }
    
    public function indexOld()
    {
        // Get a general sitemap.
        Sitemap::addSitemap('https://esvoe.com');
        Sitemap::addSitemap('https://esvoe.com/login');
        Sitemap::addSitemap('https://esvoe.com/contact');

        $this->timeline();
        
        // You can use the route helpers too.
//        Sitemap::addSitemap(route('timelines.show'));

        // Return the sitemap to the client.
        return Sitemap::index();
    }    
    
    public static function posts()
    {
        $posts = Post::all();
        
        dd($posts);

        foreach ($posts as $post) {
            Sitemap::addTag(route('post.show', $post), $post->updated_at, 'daily', '0.8');
        }

        return Sitemap::render();
    } 
    
    public function allTimelines()
    {
        $timelines = Timeline::all();
        
        foreach ($timelines as $timeline) {
            Sitemap::addTag(route('timelines.show', $timeline->username), $timeline->updated_at, 'daily', '0.8');
        }
        
        return Sitemap::render();
    }    
    
    public function pages()
    {
        $pages = Page::all();

        foreach ($pages as $page) {
            $tag = Sitemap::addTag(route('pages.show', $page), $page->updated_at, 'daily', '0.8');

            foreach ($page->images as $image) {
                $tag->addImage($image->url, $image->caption);
            }
        }

        return Sitemap::render();
    }    
}
