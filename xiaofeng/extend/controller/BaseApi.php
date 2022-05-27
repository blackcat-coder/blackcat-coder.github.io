<?php
namespace controller;

use think\exception\HttpResponseException;
use think\facade\Log;
use think\facade\Request;
use think\facade\Response;

class BaseApi
{

    /**
     * @var Request Request 实例
     */
    protected $request;

    public function __construct()
    {
        $this->request = is_null($this->request) ? Request::instance() : $this->request;
//        Log::error('接口请求参数：');
        Log::error($this->request->param());
//        if (!session('admin-user')) {
//            $this->error('请登陆后再操作');
//        }
    }

    /**
     * 返回成功的操作
     * @param string $msg 消息内容
     * @param array $data 返回数据
     * @param int $code 错误码
     */
    protected function success($msg, $data = [], $code = 200)
    {
        $result = ['success' => true, 'code' => $code, 'msg' => $msg, 'data' => $data];
        throw new HttpResponseException(\think\Response::create($result, 'json', 200));
    }

    /**
     * 返回失败的请求
     * @param string $msg 消息内容
     * @param array $data 返回数据
     * @param int $code 错误码
     */
    protected function error($msg, $data = [], $code = 400)
    {
        $result = ['success' => false, 'code' => $code, 'msg' => $msg, 'data' => $data];
        throw new HttpResponseException(\think\Response::create($result, 'json', 200));
    }
}