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

        $sitemaper->addUrl(url("/"), now()->toAtomString(), 'daily', '1.0');
        $sitemaper->addUrl(url("blogs"), now()->toAtomString(), 'daily', '1.0');
        
        $portfolios = service("portfolios")->findAll([
            ["where", "status", "show"],
            ["orderBy", "updated_at", "desc"],
            ["orderBy", "id", "desc"],
        ]);

        foreach ($portfolios as $port) {
            $sitemaper->addUrl(url("protfolio/{$port->slug}"), $port->updated_at->toAtomString(), 'weekly', '0.8');
        }
        
        $blogs = service("blogs")->findAll([
            ["where", "status", "publish"],
            ["orderBy", "publish_at", "desc"],
            ["orderBy", "id", "desc"],
        ]);

        foreach ($blogs as $blog) {
            $sitemaper->addUrl(url($blog->slug), $blog->updated_at->toAtomString(), 'weekly', '0.8');
        }
        
        return response($sitemaper->generate(), 200)->header('Content-Type', 'application/xml');
    }

    public function index() {
        $portfolios = service("portfolios")->findAll([
            ["where", "status", "show"],
            ["orderBy", "updated_at", "desc"]
        ]);
    	return $this->renderLanding("landing/home", compact("portfolios"));
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

    public function portfolio_read($slug){
        $portfolio = service("portfolios")->findOne([
            ["where", "status", "show"],
            ["where", "slug", $slug],
            ["orderBy", "updated_at", "desc"],
            ["orderBy", "id", "desc"],
        ]);

        if($portfolio) {
            return $this->renderLanding("landing/portfolio_read", compact("portfolio"));
        } else {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException(lang("res.not_found", ["Portfolio"]));
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