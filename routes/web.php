<?php
//z正式网站路由开始
//Route::get('index', function () {//主页返回四类广告（大图、小图、文字、急聘广告、最新新闻（5个）），
//    return view('index');
//测试生成session uid
use App\Http\Controllers\HomeController;

Route::any('session', ['uses' => 'PositionController@test1']);
Route::any('hasauth/{test1}/{test2}', function ($test1,$test2){
    return HomeController::hasAuth($test1,$test2);
});

//QSDB
Route::any('/', ['uses' => 'HomeController@index']);//
Route::get('/index', ['uses' => 'HomeController@index']);//
Route::get('/home', ['uses' => 'HomeController@home']);//

//区域管理
Route::get('/qsdb/region', ['uses' => 'QSDBController@regionIndex']);//页面显示
Route::post('/qsdb/region/add', ['uses' => 'QSDBController@regionAdd']);//添加区域
Route::get('/qsdb/region/modify', ['uses' => 'QSDBController@modify']);//查询区域详情
Route::post('/qsdb/region/delete', ['uses' => 'QSDBController@delete']);//删除区域
