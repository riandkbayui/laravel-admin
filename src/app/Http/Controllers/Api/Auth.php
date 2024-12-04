<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\BaseController;

class Auth  extends BaseController {

    public function __construct() {
        parent::__construct();
        //do_nothing
    }

    public function login() {
        try {
            $request = request();
            $request->validate([
                "username" => "required",
                "password" => "required",
            ]);

            $sign = service('authentication')->signIn(
                $request->post("username"), 
                $request->post("password")
            );
        
            return response([
                "message" => lang("res.success", ["Login"]),
                "redirect_to" => base_url("member/dashboard" ),
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) { 
            return response([
                "message" => lang("res.form_fail"),
                "errors" => form_error($e->errors())
            ], 400);
        } catch (\Throwable $e) {
            return response([
                "message" => $e->getMessage()
            ], 500);
        }
    }

}