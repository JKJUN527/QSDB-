<?php
//z正式网站路由开始
//Route::get('index', function () {//主页返回四类广告（大图、小图、文字、急聘广告、最新新闻（5个）），
//    return view('index');
//测试生成session uid
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QSDBController;

Route::any('session', ['uses' => 'PositionController@test1']);
//Route::get('createtable/{tablename}', ['uses' => 'QSDBController@createTable']);
Route::get('createtable/{tablename}', function ($tablename){
    return QSDBController::createTable($tablename);
});
Route::any('hasauth/{test1}/{test2}', function ($test1,$test2){
    return HomeController::hasAuth($test1,$test2);
});

//QSDB
Route::any('/', ['uses' => 'HomeController@index']);//
Route::get('/index', ['uses' => 'HomeController@index']);//
Route::get('/home', ['uses' => 'HomeController@home']);//

//区域管理
Route::get('/qsdb/region', ['uses' => 'QSDBRegionController@regionIndex']);//页面显示
Route::post('/qsdb/region/check', ['uses' => 'QSDBRegionController@checkregion']);//检查名称是否重复
Route::post('/qsdb/region/add', ['uses' => 'QSDBRegionController@regionAdd']);//添加区域
Route::get('/qsdb/region/modify', ['uses' => 'QSDBRegionController@regionModify']);//查询区域详情
//Route::post('/qsdb/region/delete', ['uses' => 'QSDBController@delete']);//删除区域
//产品模块管理
Route::get('/qsdb/products', ['uses' => 'QSDBProductController@productsIndex']);//页面显示
Route::post('/qsdb/products/add', ['uses' => 'QSDBProductController@productsAdd']);//新增产品及模块记录
Route::get('/qsdb/products/modify', ['uses' => 'QSDBProductController@productsModify']);//查询模块产品详情
//配置项管理
Route::get('/qsdb/conf', ['uses' => 'QSDBConfController@confIndex']);//页面显示
Route::post('/qsdb/conf/add', ['uses' => 'QSDBConfController@confAdd']);//添加配置项
Route::post('/qsdb/conf/modifyCheck', ['uses' => 'QSDBConfController@confCheck']);//查询配置项
Route::post('/qsdb/conf/modifyPost', ['uses' => 'QSDBConfController@confModify']);//上传修改值
Route::post('/qsdb/conf/rollback', ['uses' => 'QSDBConfController@rollBack']);//回滚上次配置值
//权限管理
Route::get('/qsdb/admin', ['uses' => 'QSDBAdminController@adminIndex']);//页面显示
Route::post('/qsdb/admin/add', ['uses' => 'QSDBAdminController@adminAdd']);//添加权限
Route::post('/qsdb/admin/delete', ['uses' => 'QSDBAdminController@adminDelete']);//删除权限


