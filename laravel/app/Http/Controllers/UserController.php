<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
     echo "hello world";
    }
 
    public function login()
    {
       return view('login');
    }
}
