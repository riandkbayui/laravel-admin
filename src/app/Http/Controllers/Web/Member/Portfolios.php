<?php

namespace App\Http\Controllers\Web\Member;
use App\Http\Controllers\BaseController;
use Exception;

class Portfolios extends BaseController {

    public function __construct() {
        parent::__construct();
        //do_nothing
    }

    public function index() {
        return $this->renderView("userpage/member/portfolios/index");
    }

    public function create(){
        $categories = service("portfolios")->getCategories();
        return $this->renderView("userpage/member/portfolios/create", compact("categories"));
    }

    public function update($id){
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            
        $portfolio = service("portfolios")->findOne([
            ["where", "id", $id]
        ]);

        if(!$portfolio) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException(lang("res.not_found", ["portfolio"]));
        }

        $categories = service("portfolios")->getCategories();

        return $this->renderView("userpage/member/portfolios/update", compact("portfolio", "categories"));
    }

}