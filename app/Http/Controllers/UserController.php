<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view ('index');
    }

    function about($name){
        $name = 'aniket';
        $users = ['aniket', 'anil', 'ajay'];
        return view('about', ['name'=>$name, 'users'=>$users]);
    }

    public function common(){
        return view ('common.common');
    }

    public function header(){
        return view ('common.header');
    }
    public function footer(){
        return view ('common.footer');
    }
}
