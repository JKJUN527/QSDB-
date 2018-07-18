<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Authmanage;
use App\Products;
use App\Region;
use App\Std;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
const AUTH_REGION = "all";
class QSDBAdminController extends Controller
{
    /*  页面显示api  */
    public function adminIndex (Request $request)
    {
        $data = array();
        $username = "jkjunjia";
        if(!HomeController::hasAuth($username,AUTH_REGION)){
            $data['has_auth'] = 0;
        }else{
            $data['has_auth'] = 1;
        }

        $data['auth'] = Authmanage::orderBy('updated_at','desc')->paginate(16);
        return view('qsdb.admin',['data'=>$data]);
    }
    /*   页面操作api   */
    public function adminAdd(Request $request){
        $data['status'] = 400;
        $data['msg'] = "未知错误";
        $username = 'jkjunjia';//可以从登陆session中获取信息

        if(HomeController::hasAuth($username,AUTH_REGION)){
            if($request->has('rtx_name') && $request->has('ch_name') && $request->has('auth_info')){
                $ch_name = $request->input('ch_name');
                $rtx_name = $request->input('rtx_name');
                $auth_info = $request->input('auth_info');
                $has_name = Authmanage::where('username',$rtx_name)->count();
                if($has_name > 0){
                    $data['msg'] = "用户已存在权限，请先删除再新建权限";
                    return $data;
                }
                $newauth = new Authmanage();

                $newauth->username = $rtx_name;
                $newauth->ch_name = $ch_name;
                $newauth->auth = $auth_info;
                $newauth->admin = $username;

                try {
                    if($newauth->save()){
                        $data['status'] = 200;
                        $data['msg'] = "操作成功";
                        return $data;
                    }else{
                        $data['status'] = 400;
                        $data['msg'] = "数据库错误";
                        return $data;
                    }
                } catch(\Illuminate\Database\QueryException $ex) {
                    $data['msg'] = "数据库错误" . $ex->getMessage();
                    return $data;
                }
            }else{
                $data['msg'] = "参数错误";
                return $data;
            }

        }else{
            $data['msg'] = "对不起，暂无处理权限，请联系管理员";
            return $data;
        }
    }
    public function adminDelete(Request $request){
        $data['status'] = 400;
        $data['msg'] = "未知错误";
        $username = 'jkjunjia';
        if(HomeController::hasAuth($username,AUTH_REGION)){
            if($request->has('id')){
                $rid = $request->input('id');
                try {
                    Authmanage::where('id', $rid)->delete();
                    $data['status'] = 200;
                    $data['msg'] = "删除成功";
                }catch (\Illuminate\Database\QueryException $ex){
                    $data['msg'] = "数据库错误" . $ex->getMessage();
                }
                return $data;
            }else{
                $data['msg'] = "参数错误";
                return $data;
            }
        }else{
            $data['msg'] = "对不起，暂无处理权限，请联系管理员";
            return $data;
        }
    }
}
