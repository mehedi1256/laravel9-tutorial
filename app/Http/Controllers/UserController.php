<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('greeting')->with('name','Mehedi');
    }

    public function show($id) {
        return 'User id is '.$id;
    }
}
