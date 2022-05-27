<?php


namespace app\controller;


use controller\BaseApi;

class App extends BaseApi
{


    /**
     * 首页信息
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        $userinfo = \think\facade\Db::name('xf_user')->where('id', '=', 1)->find();
        $confinfo = \think\facade\Db::name('xf_conf')->where('id', '=',1)->find();
        $siteinfo = \think\facade\Db::name('xf_sites')->where('status', '=', 1)->select();
        $this->success('数据信息',[
            'userinfo' => $userinfo,
            'confinfo' => $confinfo,
            'siteinfo' => $siteinfo
        ]);
    }
}