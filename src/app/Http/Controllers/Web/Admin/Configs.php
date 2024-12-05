<?php

namespace App\Http\Controllers\Web\Admin;
use App\Http\Controllers\BaseController;
use Exception;

class Configs extends BaseController {

    public function __construct() {
        parent::__construct();
        //do_nothing
    }

    public function index() {
        return $this->renderView("userpage/admin/configs/index");
    }

}