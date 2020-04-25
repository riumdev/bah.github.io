<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Post_Type;

class BaseController extends Controller
{
    //
    public function __construct() {
    	// $postType = Post_Type::orderBy('id', 'desc')->get();
    	// View::share('postType', $postType);
    }
}
