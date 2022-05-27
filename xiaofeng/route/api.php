<?php

use think\facade\Route;

Route::get('/', function (){
    return json(['code' => 0, 'message' => '非法请求']);
});

Route::group('api/v1', function () {
    Route::get('home', 'home/index');
    Route::post('upload', 'upload/index');
    Route::any('userinfo', 'user/userInfo');
    Route::post('login', 'user/login');
    Route::post('logout', 'user/logout');
    Route::post('changepwd', 'user/changePwd');
    Route::get('site_list', 'site/siteList');
    Route::post('site', 'site/site');
    Route::post('site_del', 'site/del');
    Route::any('conf', 'conf/index');
    Route::get('appinfo', 'app/index');
})->allowCrossDomain(['Access-Control-Allow-Origin:*']);