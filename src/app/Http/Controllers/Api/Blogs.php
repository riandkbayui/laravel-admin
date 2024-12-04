<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\BaseController;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class Blogs extends BaseController {

    private $upload_path = "assets/uploads/blogs/";

    public function __construct() {
        parent::__construct();
        //do_nothing
    }

    public function datatable() {;
        $dt = service("datatables", "blogs");
        $dt->select(["created_at", "title", "category", "status", "id", "tags", "slug"]);
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
                "slug"        => ["required", Rule::unique("blogs", "slug")],
                "title"       => ["required"],
                "description" => ["required"],
                "content"     => ["required"],
                "category"    => ["required"],
                "tags"        => ["required"],
                "status"      => ["required", "in:Publish,Draft"],
            ]);

            $image = $request->file('photo');
            $filename = upload_img($image, $this->upload_path, [
                ["fit", 1200, 628]
            ]);
            $link = $this->upload_path . $filename;

            $db = db_connect();
            $db->transStart();
            $tags = $request->post("tags");
            $status = $request->post("status");

            $createData = [
                "thumbnail"   => $link,
                "slug"        => $request->post("slug"),
                "title"       => $request->post("title"),
                "description" => $request->post("description"),
                "content"     => $request->post("content"),
                "category"    => $request->post("category"),
                "tags"        => json_encode($tags),
                "status"      => $status,
            ];

            if(strtolower($status)=="publish") {
                $createData['publish_at'] = date("Y-m-d H:i:s");
            }

            service("blogs")->create($createData);

            foreach ($tags as $tag) {
                $checkTag = service("tags")->findOne([
                    ["where", "name", $tag]
                ]);

                if($checkTag) { continue; }

                service("tags")->create([
                    "name" => $tag
                ]);
            }
            $db->transComplete();

            return response([
                "message" => lang("res.created", ["Post"]),
                "redirect_to" => url("member/blogs")
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
            $request->validate([
                "id"          => ["required"],
                "title"       => ["required"],
                "slug"        => ["required", Rule::unique("blogs", "slug")],
                "description" => ["required"],
                "content"     => ["required"],
                "category"    => ["required"],
                "tags"        => ["required"],
                "status"      => ["required", "in:Publish,Draft"],
            ]);

            $id = filter_var($request->post("id"), FILTER_SANITIZE_NUMBER_INT);
            
            $blogCheck = service("blogs")->findOne([
                ["where", "id", $id]
            ]);

            if(!$blogCheck) {
                throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException(lang("res.not_found", ["blog"]));
            }

            $db = db_connect();
            $db->transStart();
            $tags = $request->post("tags");
            $status = $request->post("status");
            $image = $request->file('photo');

            $updateData = [
                "slug"        => $request->post("slug"),
                "title"       => $request->post("title"),
                "description" => $request->post("description"),
                "content"     => $request->post("content"),
                "category"    => $request->post("category"),
                "tags"        => json_encode($tags),
                "status"      => $status,
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

            if(strtolower($status)=="publish") {
                $updateData['publish_at'] = date("Y-m-d H:i:s");
            } else {
                $updateData['publish_at'] = null;
            }

            service("blogs")->update($id, $updateData);

            foreach ($tags as $tag) {
                $checkTag = service("tags")->findOne([
                    ["where", "name", $tag]
                ]);

                if($checkTag) { continue; }

                service("tags")->create([
                    "name" => $tag
                ]);
            }
            $db->transComplete();

            return response([
                "message" => lang("res.updated", ["Post"]),
                "redirect_to" => url("member/blogs")
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