<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome');
Route::view('login', 'login');
Route::view('register', 'register');

Route::post('login', function () {
    $json =  request()->only('userName', 'password');    
    $client = new Client();
    $headers = [
        'Content-Type' => 'application/json'
    ];
    $body = json_encode($json);
    $request = new Request('POST', 'http://localhost:8080/login', $headers, $body);
    $res = $client->sendAsync($request)->wait();
    if($res->getBody()==""){
        return "USUARIO INCORRECTO";        
    }else{
       return $res->getBody();        
    }
});
