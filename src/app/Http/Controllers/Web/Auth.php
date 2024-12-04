<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\BaseController;
use Exception;

class Auth  extends BaseController {

    public function __construct() {
        parent::__construct();
        //do_nothing
    }

    public function login() {
    	return $this->renderAuth("auth/login");
    }

    public function logout(){
        service('authentication')->logout();
        return redirect("auth/login");
    }

}