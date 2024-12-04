<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {
        helper("text", "auth", "config", "upload");
    }

    public function renderView($view, $data=[]){
        $data['content'] = view($view, $data);
        return view("userpage/partials/layout", $data);
    }

    public function renderLanding($view, $data=[]){
        $data['content'] = view($view, $data);
        return view("landing/layout", $data);
    }

    public function renderAuth($view, $data=[]){
        $data['content'] = view($view, $data);
        return view("auth/layout", $data);
    }
}
