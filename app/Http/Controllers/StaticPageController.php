<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPageController extends Controller
{

    public function support()
    {
        return view('modules.static_pages.support');
    }


    public function about()
    {
        return view('modules.static_pages.about');
    }
}