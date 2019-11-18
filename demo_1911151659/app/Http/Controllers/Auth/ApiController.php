<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('login', 'register');
    }

    protected function username(){
        return 'name';
    }

    public function register(Request $request){
        $this->validator($request->all())->validate();

        $api_token = Str::random(80);
        $data = \array_merge($request->all(), compact('api_token'));
        $this->create($data);

        return compact('api_token');
    }

    public function login(){
        $user = User::where($this->username(), \request($this->username()))
        ->firstOrFail();

        if(!\password_verify(\request('password'), $user->password)){
            return \response()->json(['error'=> 'sorry, there are some error'], 403);
        }

        $api_token = Str::random(80);
        $user->update(['api_token'=>hash('sha256', $api_token)]);

        return \compact('api_token');
    }

    public function logout(){
        auth()->user()->update(['api_token'=>null]);
        return ['message'=>'logout success'];
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }

    protected function create(array $data){
        return User::forceCreate([
            'name'=>$data['name'],
            // 'email'=>$data['email'],
            'password'=>\password_hash($data['password'], PASSWORD_DEFAULT),
            'api_token'=>hash('sha256', $data['api_token'])
        ]);
    }

}
