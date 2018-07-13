<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Moduleconf;
use App\Products;
use App\Region;
use App\Std;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
const AUTH_REGION = "conf";
class QSDBConfController extends Controller
{
    /*  页面显示api  */
    public function init(){
        $data['condition']['productId'] = -1;
        $data['condition']['moduleId'] = -1;
        $data['condition']['region'] = -1;
//        $data['region'] = "";
//        $data['conf'] = "";
        return $data;
    }
    public function confIndex (Request $request)
    {
        $data = array();

        //初始化条件
        //如果选择了产品及模块选项
        //进行查询对应的区域
        if($request->has('productId') && $request->has('moduleId') && $request->has('region')){
            $data['condition']['productId'] = $request->input('productId');
            $data['condition']['moduleId'] = $request->input('moduleId');
            $data['condition']['region'] = $request->input('region');
            //
            $data['region'] = Region::all();
//            $data['region'] = self::searchRegion($data['condition']);
            if($data['condition']['region'] != -1 )
                $data['conf'] = self::searchConf($data['condition']);
        }else{
            $tempCondition = self::init();
            $data['condition'] = $tempCondition['condition'];
//            $data['region'] = $tempCondition['region'];
//            $data['conf'] = $tempCondition['conf'];
        }

        $temp['products_module'] = DB::table('cproduct')
            ->rightjoin('cmodule','cproduct.productId','cmodule.productId')
            ->select('cproduct.productId','productName','productDesc','moduleId','moduleName')
            ->get();
        $data['products_module'] = array();//返回产品模块数据
        foreach ($temp['products_module'] as $item ){
            $data['products_module'][$item->productId][$item->productName][] =  ['name'=>$item->moduleName,'moduleId'=>$item->moduleId];
            }

//        return $data;
        return view('qsdb.config',['data'=>$data]);
    }
    //输入查询产品ID 模块ID
    //输出对应的区域ID、名称
    public function searchRegion($condition){
        //拿到confid
        $data = array();
        $confid = Moduleconf::where('moduleId',$condition['moduleId'])
            ->where('productId',$condition['productId'])
            ->select('confId')
            ->get();
        $region = Region::all();
        foreach ($region as $item){
            $table_name = "dconfvalue_" . $item['region'];
            $count = DB::table($table_name)
                ->wherein('confId',$confid)
                ->count();
            if($count > 0 ) $data[] = $item['region'];
            continue;
        }
        return $data;
    }
    //输入区域ID
    //输出对应区域下所有配置项
    public function searchConf($condition){
        if($condition['region'] == -1) return "";
        $confid = Moduleconf::where('moduleId',$condition['moduleId'])
            ->where('productId',$condition['productId'])
            ->select('confId')
            ->get();
        $table_name = "dconfvalue_" . $condition['region'];
        $conf = DB::table($table_name)
            ->leftjoin('cconf',$table_name .".confId",'cconf.confId')
            ->wherein($table_name . '.confId',$confid)
            ->paginate(16);
        return $conf;
    }

    //输入区域ID 配置ID（如果为-1则表示新增配置）配置项
    //输出修改成功或失败
    public function addConf(Request $request){
        $data = array();

    }

}
