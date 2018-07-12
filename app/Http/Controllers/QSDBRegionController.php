<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Products;
use App\Region;
use App\Std;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
const AUTH_REGION = "region";
class QSDBRegionController extends Controller
{
    /*  页面显示api  */
    public function regionIndex (Request $request)
    {
        $data = array();
        $data['region'] = Region::orderBy('createTime','desc')->paginate(16);

//        return $data;

        return view('qsdb.region',['data'=>$data]);
    }
    public function productsIndex(Request $request){
        $data = array();
//        $data['region'] = Region::orderBy('createTime','desc')->paginate(16);
        $data['products'] = Products::all();
        $data['products_module'] = DB::table('cproduct')
            ->leftjoin('cmodule','cproduct.productId','cmodule.productId')
            ->select('cproduct.productId','productName','productDesc','moduleId','moduleName','modulePrincipal','cmodule.createTime')
            ->paginate(16);

//        return $data;

        return view('qsdb.products',['data'=>$data]);
    }

    /*   页面操作api   */
    public function regionAdd(Request $request){
        $data['status'] = 400;
        $data['msg'] = "未知错误";
        $username = 'jkjunjia';//可以从登陆session中获取信息
        $old_table_name = ""; //用于修改表名使用
        $new_table_name = ""; //用于修改表名使用
        if(HomeController::hasAuth($username,AUTH_REGION)){
            if($request->has('ch_name') && $request->has('en_name') && $request->has('rid')){
                $ch_name = $request->input('ch_name');
                $en_name = $request->input('en_name');
                $rid = $request->input('rid');

                //修改或新增区域
                if($rid == -1){
                    $region = new Region();
                }else{
                    $region = Region::find($rid);

                    $old_table_name = $region->region;
                    $new_table_name = $en_name;
                }
                $region->region = $en_name;
                $region->name = $ch_name;
                try {
                    if($region->save()){
                        if($rid == -1 && HomeController::createTable($en_name) == 1){
                            $data['status'] = 200;
                            $data['msg'] = "操作成功";
                        }else if($rid != -1 && HomeController::modifyTable($old_table_name,$new_table_name) == 1){
                            $data['status'] = 200;
                            $data['msg'] = "操作成功";
                        }
                        return $data;
                    }else{
                        $data['status'] = 400;
                        $data['msg'] = "数据库错误";
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
    }
    public function regionModify(Request $request){
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
