<?php

namespace App\Http\Controllers\Web\Member;
use App\Http\Controllers\BaseController;
use Exception;

class Profile extends BaseController {

    public function __construct() {
        parent::__construct();
        //do_nothing
    }

    public function index() {
        return $this->renderView("userpage/member/profile/index");
    }

}