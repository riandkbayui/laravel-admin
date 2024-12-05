<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\BaseController;
use Exception;
use Illuminate\Validation\Rule;

class Portfolios extends BaseController {

    private $upload_path = "assets/uploads/portfolios/";

    public function __construct() {
        parent::__construct();
        //do_nothing
    }

    public function datatable() {;
        $dt = service("datatables", "portfolios");
        $dt->select(["created_at", "title", "category", "status", "id", "slug"]);
        return $dt->renderResult();
    }

    public function upload_img(){
        try {
            $request = request();
            $request->validate([
                'file'    => ['required','image','mimes:jpeg,png,jpg','max:2048'],
            ]);
            $image = $request->file('file');
            $filename = upload_img($image, $this->upload_path);
            $link = $this->upload_path . $filename;
            return response([
                "message" => lang("res.uploaded", ["Foto"]),
                "url" => url($link)
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

    public function create(){
        try {
            $request = request();
            $request->validate([
                "photo"       => ['required','image','mimes:jpeg,png,jpg','max:2048'],
                "slug"        => ["required", Rule::unique("portfolios", "slug")],
                "title"       => ["required"],
                "description" => ["required"],
                "content"     => ["required"],
                "information" => ["required"],
                "category"    => ["required"],
                "status"      => ["required", "in:Show,Hide"],
            ]);

            $image = $request->file('photo');
            $filename = upload_img($image, $this->upload_path, [
                ["fit", 1200, 628]
            ]);
            $link = $this->upload_path . $filename;

            $createData = [
                "thumbnail"   => $link,
                "slug"        => $request->post("slug"),
                "title"       => $request->post("title"),
                "description" => $request->post("description"),
                "content"     => $request->post("content"),
                "information" => $request->post("information"),
                "category"    => $request->post("category"),
                "status"      => $request->post("status"),
            ];

            service("portfolios")->create($createData);

            return response([
                "message" => lang("res.created", ["Portfolio"]),
                "redirect_to" => url("member/portfolios")
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

    public function update(){
        try {

            $request = request();

            $id = filter_var($request->post("id"), FILTER_SANITIZE_NUMBER_INT);
            
            $portCheck = service("portfolios")->findOne([
                ["where", "id", $id]
            ]);

            if(!$portCheck) {
                throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException(lang("res.not_found", ["portfolio"]));
            }

            $request->validate([
                "id"          => ["required"],
                "title"       => ["required"],
                "slug"        => ["required", Rule::unique("portfolios", "slug")->ignore($id, "id")],
                "description" => ["required"],
                "content"     => ["required"],
                "information" => ["required"],
                "category"    => ["required"],
                "status"      => ["required", "in:Show,Hide"],
            ]);
            
            $image = $request->file('photo');

            $updateData = [
                "slug"        => $request->post("slug"),
                "title"       => $request->post("title"),
                "description" => $request->post("description"),
                "content"     => $request->post("content"),
                "information" => $request->post("information"),
                "category"    => $request->post("category"),
                "status"      => $request->post("status"),
            ];

            if($image) {
                 $filename = upload_img($image, $this->upload_path, [
                    ["fit", 1200, 628]
                ]);

                 if($filename) {
                    $link = $this->upload_path . $filename;
                    $updateData["thumbnail"] = $link;
                 }
            }

            service("portfolios")->update($id, $updateData);

            return response([
                "message" => lang("res.updated", ["Post"]),
                "redirect_to" => url("member/portfolios")
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