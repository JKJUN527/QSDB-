<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index (Request $request)
    {
        $data = array();

        return view('index',['data'=>$data]);
    }
    public function  home (Request $request)
    {
        $data = array();

        return view('home',['data'=>$data]);
    }

    static public function hasAuth($username , $auth){
        if($username == "" || $auth == ""){
            return 0;
        }
        $hasAuth = Auth::where('username',$username)->first();
        if($hasAuth == "") return 0;
        else {
            foreach (explode(';',$hasAuth->auth) as $item){
                if($item == $auth || $item == 'all'){
                    return 1;
                }
            }
            return 0;
        }
    }
}
