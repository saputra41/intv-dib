<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function create()
    {
        return view('create');
    }

    public function list()
    {
        return view('list');
    }

    public function edit()
    {
        return view('edit');
    }
}
