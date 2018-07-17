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
use App\Products;
use App\Region;
use App\Std;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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


    /*   公共api   */
    //检查区域名是否占用
    public function checkregion(Request $request){
        $data['status'] = 400;
        $data['msg'] = '未知错误';
        if($request->has('region')){
            $region = $request->input('region');
            $has_region = Region::where('region',$region)->count();
            if($has_region > 0){
                $data['msg'] = '名称已占用';
            }else{
                $data['status'] = 200;
            }
        }
        return $data;
    }
    //新建区域时调用函数新建数据表
    //数据表默认值填充std表内容
    public static function createTable($table_name){
        $table = "dconfvalue_" . $table_name;
        if(!Schema::hasTable($table)){
            try{
                Schema::create($table, function ($table_info) {
                    $table_info->primary('confId');
                    $table_info->integer('confId');
                    $table_info->longtext('value');
                    $table_info->longtext('lastValue')->nullable();
                    $table_info->timestamp('updateTime');
                });
                $std_data = Std::all();
                foreach ($std_data as $item){
                    $temp['confId'] = $item->confId;
                    $temp['value'] = $item->value;
                    $temp['lastValue'] = $item->lastValue;
                    $data[] = $temp;
                }
                DB::table($table)->insert($data);
                return 1;//创建表成功
            }catch (\Illuminate\Database\QueryException $ex){
                return -1;//数据库错误
            }

        }
        return 0; //创建失败
    }
    //修改区域英文名称时调用函数修改数据库表名
    public static function modifyTable($old_name,$new_name){
        if($old_name == $new_name) return 0;
        $old_table = 'dconfvalue_' . $old_name;
        $new_table = 'dconfvalue_' . $new_name;
        try{
            if(Schema::hasTable($old_table)) {
                Schema::rename($old_table, $new_table);
            }
            return 1;
        }catch (\Illuminate\Database\QueryException $ex){
            return 0;
        }
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
