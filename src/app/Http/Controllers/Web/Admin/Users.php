<?php

namespace App\Http\Controllers\Web\Admin;
use App\Http\Controllers\BaseController;
use Exception;

class Users extends BaseController {

    public function __construct() {
        parent::__construct();
        //do_nothing
    }

    public function index() {
        return $this->renderView("userpage/admin/users/index");
    }

    public function create() {
        return $this->renderView("userpage/admin/users/create");
    }

    public function update($id) {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $user = service("users")->findOne([
            ["where", "id", $id]
        ]);

        if(!$user) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException(lang("res.not_found", ["Pengguna"]));
        }
        return $this->renderView("userpage/admin/users/update", compact("user"));
    }

}