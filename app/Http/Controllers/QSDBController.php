<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;
const AUTH_REGION = "region";
class QSDBController extends Controller
{
    public function regionIndex (Request $request)
    {
        $data = array();
        $data['region'] = Region::orderBy('createTime','desc')->paginate(16);

//        return $data;

        return view('qsdb.region',['data'=>$data]);
    }
    public function regionAdd(Request $request){
        $data['status'] = 400;
        $data['msg'] = "未知错误";
        $username = 'jkjunjia';//可以从登陆session中获取信息
        if(HomeController::hasAuth($username,AUTH_REGION)){
            if($request->has('ch_name') && $request->has('en_name') && $request->has('rid')){
                $ch_name = $request->input('ch_name');
                $en_name = $request->input('en_name');
                $rid = $request->input('rid');

                //修改或新增区域
                if($rid == -1){
                    $region = new Region();
                }else
                    $region = Region::find($rid);
                $region->region = $en_name;
                $region->name = $ch_name;
                try {
                    if($region->save()){
                        $data['status'] = 200;
                        $data['msg'] = "操作成功";
                        return $data;
                    }
                } catch(\Illuminate\Database\QueryException $ex) {
                    $data['msg'] = "数据库错误";
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
        return $data;
    }
    public function modify(Request $request){
        $data['status'] = 400;
        $data['msg'] = "未知错误";
        $username = 'jkjunjia';
        if(HomeController::hasAuth($username,AUTH_REGION)){
            if($request->has('rid')){
                $rid = $request->input('rid');
                $data['detail'] = Region::find($rid);
                if($data['detail'] == ""){
                    $data['msg'] = "查无结果";
                }else{
                    $data['status'] = 200;
                    $data['msg'] = "查询成功";
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
    public function delete(Request $request){
        $data['status'] = 400;
        $data['msg'] = "未知错误";
        $username = 'jkjunjia';
        if(HomeController::hasAuth($username,AUTH_REGION)){
            if($request->has('rid')){
                $rid = $request->input('rid');
                try {
                    Region::where('id', $rid)->delete();
                    $data['status'] = 200;
                    $data['msg'] = "删除成功";
                }catch (\Illuminate\Database\QueryException $ex){
                    $data['msg'] = "数据库错误";
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
