<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\BaseController;
use Exception;
use Illuminate\Validation\Rule;

class Users extends BaseController {

    private $upload_path = "assets/uploads/blogs/";

    public function __construct() {
        parent::__construct();
        //do_nothing
    }

    public function datatable() {;
        $dt = service("datatables", "users");
        $dt->select(["created_at", "name", "username", "role", "status", "id"]);
        return $dt->renderResult();
    }

    public function create() {
        try {
            $request = request();

            $rules = [
                "username"              => ["required", Rule::unique("users", "username")],
                "email"                 => ["required", Rule::unique("users", "email")],
                "name"                  => ["required"],
                "phone"                 => ["required"],
                'photo'                 => ['nullable','image','mimes:jpeg,png,jpg','max:2048'],
                "password"              => ["required", "min:8"],
                "password_confrimation" => ["required", "same:password"],
            ];

            $request->validate($rules);
            $image = $request->file('photo');
            $data = [
                "username" => filter_var($request->post("username"), FILTER_CALLBACK, ["options" => "inputUsername"]),
                "email" => filter_var($request->post("email"), FILTER_CALLBACK, ["options" => "inputEmail"]),
                "name" => $request->post("name"),
                "phone" => filter_var($request->post("phone"), FILTER_SANITIZE_NUMBER_INT),
                "password" => filter_var($request->post("password"), FILTER_CALLBACK, ["options" => "inputPassword"]),
            ];
            
            if($image) {
                [$w, $h] = service("users")->photo_size;
                $filename = upload_img($image, $this->upload_path, [
                    ["fit", $w, $h]
                ]);
                $data["photo"] = $this->upload_path . $filename;
            } else {
                $data["photo"] = "assets/uploads/profiles/user.png";
            }

            service("users")->create($data);

            return response([
                "message" => lang("res.created", ["Data Pengguna"]),
                "redirect_to" => url("admin/users")
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

    public function update() {
        try {
            $request = request();
            $id = filter_var($request->post("id"), FILTER_SANITIZE_NUMBER_INT);
            $password = $request->post("password");
            $password_confrimation = $request->post("password_confrimation");

            $user = service("users")->findOne([
                ["where", "id", $id]
            ]);

            if(!$user) {
                throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException(lang("res.not_found", ["Pengguna"]));
            }

            $rules = [
                "username" => ["required", Rule::unique("users", "username")->ignore($id, "id")],
                "email"    => ["required", Rule::unique("users", "email")->ignore($id, "id")],
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

            service("users")->update($user->id, $data);

            return response([
                "message" => lang("res.updated", ["Data Pengguna"]),
                "redirect_to" => url("admin/users")
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