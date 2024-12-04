<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\BaseController;
use Exception;
use Illuminate\Validation\Rule;

class Profile extends BaseController {

    private $upload_path = "assets/uploads/profiles/";

    public function __construct() {
        parent::__construct();
        //do_nothing
    }

    public function index() {
        try {
            $request = request();
            $password = $request->post("password");
            $password_confrimation = $request->post("password_confrimation");
            $rules = [
                "username" => ["required", Rule::unique("users", "username")->ignore(userId(), "id")],
                "email"    => ["required", Rule::unique("users", "email")->ignore(userId(), "id")],
                "name"     => ["required"],
                "phone"    => ["required"],
                'photo'    => ['nullable','image','mimes:jpeg,png,jpg','max:2048'],
            ];

            if($password || $password_confrimation) {
                $rules["password"] = ["required", "min:8"];
                $rules["password_confrimation"] = ["required", "same:password"];
            }

            $request->validate($rules);
            $image = $request->file('photo');
            $data = [
                "username" => filter_var($request->post("username"), FILTER_CALLBACK, ["options" => "inputUsername"]),
                "email" => filter_var($request->post("email"), FILTER_CALLBACK, ["options" => "inputEmail"]),
                "name" => $request->post("name"),
                "phone" => filter_var($request->post("phone"), FILTER_SANITIZE_NUMBER_INT),
            ];

            if($password) {
                $data["password"] = filter_var($request->post("password"), FILTER_CALLBACK, ["options" => "inputPassword"]);
            }
            
            if($image) {
                [$w, $h] = service("users")->photo_size;
                $filename = upload_img($image, $this->upload_path, [
                    ["fit", $w, $h]
                ]);
                $data["photo"] = $this->upload_path . $filename;
            }

            service("users")->update(userId(), $data);

            return response([
                "message" => lang("res.updated", ["Profile"]),
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