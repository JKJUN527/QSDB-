<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\Conf;
use App\Moduleconf;
use App\Products;
use App\Region;
use App\Std;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Psy\Util\Json;
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
    public function confAdd(Request $request){
        $data = array();
        $data['status'] = 400;
        $data['msg'] = "未知错误";
        $username = 'jkjunjia';
        if(!HomeController::hasAuth($username,AUTH_REGION)){
            $data['msg'] = "无权操作";
            return $data;
        }
        if($request->has('conf_type') && $request->has('region') && $request->has('moduleId') && $request->has('productId')){
            $conf_type = $request->input('conf_type');
            $region = $request->input('region');
            $moduleId = $request->input('moduleId');
            $productId = $request->input('productId');
        }else{
            $data['msg'] = "参数错误";
            return $data;
        }
        switch ($conf_type){
            case 0:
                try{
                    $key_name = $request->input('key_conf_name');
                    $key_value = $request->input('key_conf_value');
                    //新增配置表
                    $conf = new Conf();
                    $conf->confName = $key_name;
                    $conf->type = 0;
                    $conf->save();
                    //插入地域配置值
                    $insertConf = DB::table("dconfvalue_" . $region)
                        ->insert(
                            [
                                'confId'=>$conf->confId,
                                'value'=>$key_value
                            ]
                        );
                    //新增配置与产品-模块的关系
                    $insertModuleConf = Moduleconf::insert(
                        [
                            'moduleId'=>$moduleId,
                            'confId'=>$conf->confId,
                            'productId'=>$productId
                        ]
                    );
                    $data['status'] = 200;
                    $data['msg'] = "配置新增成功";
                }catch (\Illuminate\Database\QueryException $ex){
                    $data['msg'] = "数据库错误" . $ex->getMessage();
                    return $data;
                }
                break;
            case 1:
                try{
                    $confvalue1 = "";
                    $confvalue2 = "";
                    $confvalue3 = "";
                    //获取传回值--必填
                    $cdb_conf_name = $request->input('cdb_conf_name');
                    $confvalue['default'] = $request->input('cdb_db_name');
                    $confvalue['host'] = $request->input('cdb_db_ip');
                    $confvalue['port'] = $request->input('cdb_db_port');
                    $confvalue['user'] = $request->input('cdb_db_user');
                    $confvalue['passwd'] = $request->input('cdb_db_pass');
                    $confvalue1 = json_encode($confvalue);
                    //获取传回值--从库信息
                    if($request->input('NEWSLAVE')){
                        $confvalue['default'] = $request->input('cdb_db_slave_name');
                        $confvalue['host'] = $request->input('cdb_db_slave_ip');
                        $confvalue['port'] = $request->input('cdb_db_slave_port');
                        $confvalue['user'] = $request->input('cdb_db_slave_user');
                        $confvalue['passwd'] = $request->input('cdb_db_slave_pass');
                        $confvalue2 = json_encode($confvalue);
                    }
                    if($request->input('NEWREADE')){
                        $confvalue['default'] = $request->input('cdb_db_read_slave_name');
                        $confvalue['host'] = $request->input('cdb_db_read_slave_ip');
                        $confvalue['port'] = $request->input('cdb_db_read_slave_port');
                        $confvalue['user'] = $request->input('cdb_db_read_slave_user');
                        $confvalue['passwd'] = $request->input('cdb_db_read_slave_pass');
                        $confvalue3 = json_encode($confvalue);
                    }
                    //新增三个配置
                    //命名规范 db-name.main   db-name.slave  db-name.ro
                    $conf1 = new Conf();
                    $conf2 = new Conf();
                    $conf3 = new Conf();

                    $conf1->confName = "db." . $cdb_conf_name . ".main";
                    $conf1->type = 1;
                    $conf1->save();
                    $conf2->confName = "db." . $cdb_conf_name . ".slave";
                    $conf2->type = 1;
                    $conf2->save();
                    $conf3->confName = "db." . $cdb_conf_name . ".ro";
                    $conf3->type = 1;
                    $conf3->save();
                    //插入地域配置值
                    $insertConf = DB::table("dconfvalue_" . $region)
                        ->insert(
                            [
                                ['confId'=>$conf1->confId, 'value'=>$confvalue1],
                                ['confId'=>$conf2->confId, 'value'=>$confvalue2],
                                ['confId'=>$conf3->confId, 'value'=>$confvalue3]
                            ]
                        );
                    //新增配置与产品-模块的关系
                    $insertModuleConf = Moduleconf::insert(
                        [
                            ['moduleId'=>$moduleId, 'confId'=>$conf1->confId, 'productId'=>$productId],
                            ['moduleId'=>$moduleId, 'confId'=>$conf2->confId, 'productId'=>$productId],
                            ['moduleId'=>$moduleId, 'confId'=>$conf3->confId, 'productId'=>$productId]
                        ]
                    );
                    $data['status'] = 200;
                    $data['msg'] = "配置新增成功";
                }catch (\Illuminate\Database\QueryException $ex){
                    $data['msg'] = "数据库错误" . $ex->getMessage();
                    return $data;
                }
                break;
            case 2://IPLIST
                try{
                    $cvm_type = $request->input('cvm_inport_type');
                    $conf_value['default'] = $request->input('cvm_conf_value');
                    $confvalue = json_encode($conf_value);
                    //新增配置表
                    $conf = new Conf();
                    $conf->confName = "db." . "iplist";
                    if($cvm_type == 0) $conf->type = 21;
                    else $conf->type = 22;
                    $conf->save();
                    //插入地域配置值
                    $insertConf = DB::table("dconfvalue_" . $region)
                        ->insert(
                            [
                                'confId'=>$conf->confId,
                                'value'=>$confvalue
                            ]
                        );
                    //新增配置与产品-模块的关系
                    $insertModuleConf = Moduleconf::insert(
                        [
                            'moduleId'=>$moduleId,
                            'confId'=>$conf->confId,
                            'productId'=>$productId
                        ]
                    );
                    $data['status'] = 200;
                    $data['msg'] = "配置新增成功";
                }catch (\Illuminate\Database\QueryException $ex){
                    $data['msg'] = "数据库错误" . $ex->getMessage();
                    return $data;
                }
                break;
            default:
                $data['msg'] = "输入配置类型值错误";
        }
        return $data;
    }

    //输入confID
    //输出conftype 及具体配置项值
    public function confCheck(Request $request){
        $data = array();
        $data['status'] = 400;
        $data['msg'] = "未知错误";
        $username = 'jkjunjia';
        if(!HomeController::hasAuth($username,AUTH_REGION)){
            $data['msg'] = "无权操作";
            return $data;
        }
        if($request->has('confId') && $request->has('region')){
            $confId = $request->input('confId');
            $region = $request->input('region');
            try{
                $data['conf'] = Conf::find($confId);
                $data['confvalue'] = DB::table('dconfvalue_' . $region)->where('confId',$confId)->first();
                $data['status'] = 200;
            } catch (\Illuminate\Database\QueryException $ex){
                $data['msg'] = "数据库错误" . $ex->getMessage();
            }
            return $data;
        }
        return $data;
    }
    //接收提交修改数据，并修改对应配置项
    public function confModify(Request $request){
        $data = array();
        $data['status'] = 400;
        $data['msg'] = "未知错误";
        $username = 'jkjunjia';
        if(!HomeController::hasAuth($username,AUTH_REGION)){
            $data['msg'] = "无权操作";
            return $data;
        }
        if($request->has('confId') && $request->has('conf_type') && $request->has('region')){
            $confId = $request->input('confId');
            $conf_type = $request->input('conf_type');
            $region = $request->input('region');
            switch ($conf_type){
                case 0:
                    try{
                        $key_name = $request->input('key_conf_name');
                        $key_value = $request->input('key_conf_value');
                        //修改配置表
                        $conf = Conf::find($confId);
                        $conf->confName = $key_name;
                        $conf->save();
                        //修改地域配置值

                        $insertConf = DB::table("dconfvalue_" . $region)->where('confId',$confId)->first();
                        $oldvalue = $insertConf->value;
                        DB::table("dconfvalue_" . $region)->where('confId',$confId)
                            ->update([
                                'value'=>$key_value,
                                'lastValue'=>$oldvalue
                            ]);

                        $data['status'] = 200;
                        $data['msg'] = "配置修改成功";
                    }catch (\Illuminate\Database\QueryException $ex){
                        $data['msg'] = "数据库错误" . $ex->getMessage();
                        return $data;
                    }
                    break;
                case 1:
                    try{
                        $conf_value = "";

                        //获取传回值--必填
                        $confvalue['default'] = $request->input('cdb_modify_db_name');
                        $confvalue['host'] = $request->input('cdb_modify_db_ip');
                        $confvalue['port'] = $request->input('cdb_modify_db_port');
                        $confvalue['user'] = $request->input('cdb_modify_db_user');
                        $confvalue['passwd'] = $request->input('cdb_modify_db_pass');
                        $conf_value = json_encode($confvalue);

                        $insertConf = DB::table("dconfvalue_" . $region)->where('confId',$confId)->first();
                        $oldvalue = $insertConf->value;
                        DB::table("dconfvalue_" . $region)->where('confId',$confId)
                            ->update([
                                'value'=>$conf_value,
                                'lastValue'=>$oldvalue
                            ]);
                        $data['status'] = 200;
                        $data['msg'] = "配置新增成功";
                    }catch (\Illuminate\Database\QueryException $ex){
                        $data['msg'] = "数据库错误" . $ex->getMessage();
                        return $data;
                    }
                    break;
                case 2:
                    try{
                        $cvm_type = $request->input('cvm_inport_type');
                        $confvalue['default'] = $request->input('cvm_conf_value');
                        $conf_value = json_encode($confvalue);
                        //修改配置表
                        $conf = Conf::find($confId);
                        if($cvm_type == 0) $conf->type = 21;
                        else $conf->type = 22;
                        $conf->save();
                        //修改地域配置值
                        $insertConf = DB::table("dconfvalue_" . $region)->where('confId',$confId)->first();
                        $oldvalue = $insertConf->value;
                        DB::table("dconfvalue_" . $region)->where('confId',$confId)
                            ->update([
                                'value'=>$conf_value,
                                'lastValue'=>$oldvalue
                            ]);

                        $data['status'] = 200;
                        $data['msg'] = "配置新增成功";
                    }catch (\Illuminate\Database\QueryException $ex){
                        $data['msg'] = "数据库错误" . $ex->getMessage();
                        return $data;
                    }
                    break;
                default:
                    $data['msg'] = "输入配置类型值错误";
            }
        }
        return $data;
    }
    public function rollBack(Request $request){
        $data  = array();
        $data['status'] = 400;
        $data['msg'] = "未知错误";
        $username = 'jkjunjia';
        if(!HomeController::hasAuth($username,AUTH_REGION)){
            $data['msg'] = "无权操作";
            return $data;
        }
        if($request->has('region') && $request->has('confId')){
            $region = $request->input('region');
            $confId = $request->input('confId');
            try{
                //回滚地域配置值
                $insertConf = DB::table("dconfvalue_" . $region)->where('confId',$confId)->first();
                DB::table("dconfvalue_" . $region)->where('confId',$confId)
                    ->update([
                        'value'=>$insertConf->lastValue,
                        'lastValue'=>$insertConf->value
                    ]);
                $data['status'] = 200;
                $data['msg'] = "回滚成功";
            }catch (\Illuminate\Database\QueryException $ex){
                $data['msg'] = "数据库错误" . $ex->getMessage();
                return $data;
            }
        }else{
            $data['msg'] = '参数错误';
        }
        return $data;
    }

}
