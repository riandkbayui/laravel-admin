<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\BaseController;
use Exception;

class Configs extends BaseController {

    public function __construct() {
        parent::__construct();
        //do_nothing
    }

    public function datatable() {
        $dt = service("datatables", "configs");
        $dt->select(["description", "value", "id"]);
        return $dt->renderResult();
    }

    public function update(){
        try {
            $request = request();
            $request->validate([
                "id" => "required",
                "value" => "required",
            ]);

            $id = filter_var($request->post("id"), FILTER_SANITIZE_NUMBER_INT);
            $value = $request->post("value");

            $check = service("configs")->findOne([
                ["where", "id", $id]
            ]);

            if(!$check) {
                throw new Exception(lang("res.not_found", ["Konfigurasi"]));
            }

            service("configs")->update($id, [
                "value" => $value
            ]);
        
            return response([
                "message" => lang("res.updated", ["Konfigurasi"]),
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