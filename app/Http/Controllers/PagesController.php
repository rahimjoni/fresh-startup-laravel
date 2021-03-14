<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index($slug){
        $page = Page::findByslug($slug);
        return $page;
    }
}
