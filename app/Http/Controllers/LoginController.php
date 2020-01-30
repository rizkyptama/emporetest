<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ModelLogin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        if(!Session::get('login')){
            $kiriman = ["title" => "Log In"];
            return view('login', $kiriman);
        } else {
            if (Session::get('type') == 'admin') {
                return redirect('/dashboardAdmin')->with('alert','Kamu Sudah Login !');
            } else if (Session::get('type') == 'user') {
                return redirect('/dashboardUser')->with('alert','Kamu Sudah Login !');
            }
        }
    }

    public function login(Request $request){

        $username = $request->username;
        $password = Hash::make($request->password);

        $data = ModelLogin::where('username', $username)->first();

        if ($data && Hash::check($request->password, $data->password)) {
            Session::put('kd_user', $data->kd_user);
            Session::put('type', $data->type);
            Session::put('username', $data->username);
            Session::put('nama', $data->nama);
            Session::put('login',TRUE);
            if ($data->type == "admin") {
                return redirect('/dashboardAdmin');
            } else if ($data->type == "user") {
                return redirect('/dashboardUser');
            }
        } else {
            return redirect('/')->with('alert','Password atau Username Salah!');
        }
    }

    public function logout(){
        Session::flush();
        return redirect('/')->with('alert-success','Logout Success');
    }
}
