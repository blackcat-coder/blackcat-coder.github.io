<?php


namespace app\controller;


use controller\BaseApi;

class Home extends BaseApi
{
    /**
     * 后天首页
     * 获取服务器信息
     */
    public function index()
    {
        $data = [
            'env' => 'PHP+MYSQL',
            'service' => $_SERVER['SERVER_SOFTWARE'],
            'php_version' => PHP_VERSION,
            'path' => __FILE__
        ];
        $this->success('数据获取成功', $data);
    }
}