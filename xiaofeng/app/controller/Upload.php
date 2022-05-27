<?php


namespace app\controller;


use controller\BaseApi;
use think\facade\Log;
use think\facade\Request;

class Upload extends BaseApi
{
    /**
     * 上传接口
     * base64
     */
    public function index()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');
        // 上传到本地服务器
        $savename = \think\facade\Filesystem::putFile( 'upload', $file);
        Log::error($savename);
        if ($savename) {
            $this->success('上传成功', [
                'path' => Request::domain().'/storage/'.$savename
            ]);
        }
        $this->error('上传失败');
    }
}