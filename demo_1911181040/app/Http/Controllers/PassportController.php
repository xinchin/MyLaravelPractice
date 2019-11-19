<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class PassportController extends Controller
{
    protected $clientId;
    protected $clientSecret;

    public function __construct(){
        $this->middleware('auth')->except('login', 'register', 'refresh');
        // $client = DB::table('oauth_clients')->where('id', 2)->first();
        $client = Cache::remember('password_client', 60*5, function(){
            return DB::table('oauth_clients')->where('id', 2)->first();
        });
        $this->clientId = $client->id;
        $this->clientSecret = $client->secret;
    }

    protected function username(){
        return 'email';
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }

    protected function create(array $data){
        return User::forceCreate([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>\password_hash($data['password'], PASSWORD_DEFAULT),
        ]);
    }

    private function getToken(){
        $response = (new Client())->post('http://localhost:8000/api/oauth/token',[
            'form_params' =>[
                'grant_type'=>'password',
                'username'=>request('email'),
                'password'=>request('password'),
                'client_id'=>$this->clientId,
                'client_secret'=>$this->clientSecret,
                'scope'=>'*',
            ]
        ]);
        return $response->getBody();
    }

    public function register(){
        $this->validator(request()->all())->validate();
        $this->create(request()->all());
        // return request()->all();
        return $this->getToken();
    }

    public function login()
    {
        $user = User::where($this->username(), request($this->username()))
        ->firstOrFail();

        if(!\password_verify(request('password'),$user->password)){
            return response()->json(['error'], 403);
        }
        return $this->getToken();
    }

    public function refresh()
    {
        $response =  (new Client())->post('http://localhost:8000/api/oauth/token',[
            'form_params' =>[
                'grant_type'=>'refresh_token',
                'refresh_token'=>request('refresh_token'),
                'client_id'=>$this->clientId,
                'client_secret'=>$this->clientSecret,
                'scope'=>'*',
            ]
        ]);
        return $response->getBody();
    }

}
