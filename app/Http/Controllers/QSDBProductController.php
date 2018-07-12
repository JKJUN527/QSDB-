<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Module;
use App\Products;
use App\Region;
use App\Std;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
const AUTH_REGION = "products";
class QSDBProductController extends Controller
{
    public function productsIndex(Request $request){
        $data = array();
//        $data['region'] = Region::orderBy('createTime','desc')->paginate(16);
        $data['products'] = Products::all();
        $data['products_module'] = DB::table('cproduct')
            ->rightjoin('cmodule','cproduct.productId','cmodule.productId')
            ->select('cproduct.productId','productName','productDesc','moduleId','moduleName','modulePrincipal','cmodule.createTime')
            ->paginate(16);

//        return $data;

        return view('qsdb.products',['data'=>$data]);
    }
    public function productsAdd(Request $request){
        $data['status'] = 400;
        $data['msg'] = "未知错误";
        $username = 'jkjunjia';//可以从登陆session中获取信息
        if(HomeController::hasAuth($username,AUTH_REGION)){
            if($request->has('productid') && $request->has('module_en_name') && $request->has('module_principal')){
                $productid = $request->input('productid');
                $products_en_name = $request->input('products_en_name');
                $products_ch_name = $request->input('products_ch_name');
                $module_en_name = $request->input('module_en_name');
                $module_ch_name = $request->input('module_ch_name');
                $module_principal = $request->input('module_principal');
                $mid = $request->input('mid');
                //判断是修改模块还是新增模块
                if($mid == -1){//新增模块
                    $new_module = new Module();
                }else{
                    $new_module = Module::find($mid);
                }

                try {
                    //是否新增产品
                    if($productid == -1){
                        //新增产品
                        $new_product = new Products();
                        $new_product->productName  = $products_en_name;
                        $new_product->productDesc  = $products_ch_name;
                        $new_product->save();
                        //新增模块
                        $new_module->productId = $new_product->productId;
                    }else{
                        //新增模块
                        $new_module->productId = $productid;
                    }
                    $new_module->moduleName = $module_en_name;
                    $new_module->moduleDesc = $module_ch_name;
                    $new_module->modulePrincipal = $module_principal;
                    if($new_module->save()){
                        $data['status'] = 200;
                        $data['msg'] = "操作成功";
                    }else{
                        $data['msg'] = "保存模块到数据库出错";
                    }
                    return $data;
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
    public function productsModify(Request $request){
        $data['status'] = 400;
        $data['msg'] = "未知错误";
        $username = 'jkjunjia';
        if(HomeController::hasAuth($username,AUTH_REGION)){
            if($request->has('rid')){
                $rid = $request->input('rid');
                $data['detail'] = Module::find($rid);
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
}
