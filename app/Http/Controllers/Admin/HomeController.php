<?php

namespace App\Http\Controllers\Admin;

class HomeController
{
    public function index()
    {
        return view('home');
        // return view('user-site.index', ['title' => 'home']);
    }


}
