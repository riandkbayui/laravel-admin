<?php

use Intervention\Image\Facades\Image;

if(!function_exists("upload_img")) {
    
    function upload_img($file, $path, $params=[]) {
        try {
            $filename = uniqid() . "_" . random_string("crypto", 4) . ".jpeg";
            $img = Image::make($file);
            foreach ($params as $v) {
                $fun = $v[0];
                unset($v[0]);
                $img->{$fun}(...$v);
            }
    
            $img->save(FCPATH . $path . $filename);
            return $filename;
        } catch (\Throwable $th) {
            return "";
        }
    }

}