<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only('show');
        // $this->middleware('auth')->only(['show', 'test']);
        // $this->middleware('auth')->except('show');
    }

    public function index(){
        return 'Hello :: index';
    }

    public function show(){
        return 'Hello :: show';
    }

    public function test(){
        return 'Hello :: test';
    }
}
