<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\BaseController;
use Exception;

class Home extends BaseController {

    public function __construct() {
        parent::__construct();
        //do_nothing
    }

    public function sitemap(){
        $sitemaper = sitemaper();
        $blogs = service("blogs")->findAll([
            ["where", "status", "publish"],
            ["orderBy", "publish_at", "desc"],
            ["orderBy", "id", "desc"],
        ]);

        $sitemaper->addUrl(url("/"), now()->toAtomString(), 'daily', '1.0');
        $sitemaper->addUrl(url("blogs"), now()->toAtomString(), 'daily', '1.0');
        
        foreach ($blogs as $blog) {
            $sitemaper->addUrl(url($blog->slug), $blog->updated_at->toAtomString(), 'weekly', '0.8');
        }
        
        return response($sitemaper->generate(), 200)->header('Content-Type', 'application/xml');
    }

    public function index() {
    	return $this->renderLanding("landing/home");
    }

    public function blogs() {
        $search = request()->get("search");
        $params = [
            ["where", "status", "publish"],
            ["orderBy", "publish_at", "desc"],
            ["orderBy", "id", "desc"],
        ];

        if($search) {
            $params[] = ["where", function($query) use ($search) {
                $query->orWhere("title", "LIKE", "%{$search}%");
                $query->orWhere("description", "LIKE", "%{$search}%");
            }];
        }

        $blogs = service("blogs")->paginate(5, $params);

        if($search) {
            $blogs->appends(["search" => $search]);
        }        

        $categories = service("blogs")->getCategories();
        $tags = service("tags")->getList();
        
        return $this->renderLanding("landing/blogs", compact("blogs", "categories", "tags"));
    }

    public function blogRead($slug){
        $blog = service("blogs")->findOne([
            ["where", "status", "publish"],
            ["where", "slug", $slug],
            ["orderBy", "publish_at", "desc"],
            ["orderBy", "id", "desc"],
        ]);

        if($blog) {
            $blogtags = json_decode($blog->tags);
            $categories = service("blogs")->getCategories();
            $tags = service("tags")->getList();
            $latest = service("blogs")->findAll([
                ["where", "status", "publish"],
                ["orderBy", "publish_at", "desc"],
                ["orderBy", "id", "desc"],
                ["limit", 5]
            ]);
            return $this->renderLanding("landing/blog_read", compact("blog", "blogtags", "categories", "tags"));
        } else {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException(lang("res.not_found", ["blog"]));
        }
    }

    public function blogTag($tag="") {
        $params = [
            ["where", "status", "publish"],
            ["whereJsonContains", "tags", $tag],
            ["orderBy", "publish_at", "desc"],
            ["orderBy", "id", "desc"],
        ];

        $blogs = service("blogs")->paginate(5, $params);    

        $categories = service("blogs")->getCategories();
        $tags = service("tags")->getList();
        
        return $this->renderLanding("landing/blogs", compact("blogs", "categories", "tags"));
    }

    public function blogCategory($cat="") {
        $params = [
            ["where", "status", "publish"],
            ["where", "category", $cat],
            ["orderBy", "publish_at", "desc"],
            ["orderBy", "id", "desc"],
        ];

        $blogs = service("blogs")->paginate(5, $params);    

        $categories = service("blogs")->getCategories();
        $tags = service("tags")->getList();
        
        return $this->renderLanding("landing/blogs", compact("blogs", "categories", "tags"));
    }

}