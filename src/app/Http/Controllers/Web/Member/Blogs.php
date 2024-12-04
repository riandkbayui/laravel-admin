<?php

namespace App\Http\Controllers\Web\Member;
use App\Http\Controllers\BaseController;
use Exception;

class Blogs extends BaseController {

    public function __construct() {
        parent::__construct();
        //do_nothing
    }

    public function index() {
        return $this->renderView("userpage/member/blogs/index");
    }

    public function create(){
        $categories = service("blogs")->getCategories();
        return $this->renderView("userpage/member/blogs/create", compact("categories"));
    }

    public function update($id){
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            
        $blog = service("blogs")->findOne([
            ["where", "id", $id]
        ]);

        if(!$blog) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException(lang("res.not_found", ["blog"]));
        }

        $categories = service("blogs")->getCategories();
        $tags = json_decode($blog->tags);

        return $this->renderView("userpage/member/blogs/update", compact("blog", "categories", "tags"));
    }

}