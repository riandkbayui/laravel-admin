<?php

namespace App\Http\Controllers\Web\Member;
use App\Http\Controllers\BaseController;
use Exception;

class Dashboard extends BaseController {

    public function __construct() {
        parent::__construct();
        //do_nothing
    }

    public function index() {
        $blog = service("blogs")->findOne([
            ["selectRaw", "count(IF(status='Publish', 1, null)) as publish"],
            ["selectRaw", "count(IF(status='Draft', 1, null)) as draft"],
            ["selectRaw", "count(0) as total"],
        ]);
        return $this->renderView("userpage/member/dashboard/index", compact("blog"));
    }

}