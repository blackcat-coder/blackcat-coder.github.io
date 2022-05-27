<?php


namespace app\controller;


use controller\BaseApi;
use think\facade\Db;
use think\facade\Request;

class Site extends BaseApi
{


    /**
     * 站点列表
     */
    public function siteList()
    {
        $siteList = Db::name('xf_sites')->where('status', '=', 1)->select();
        $this->success('站点列表', $siteList);
    }

    /**
     * 新增站点
     */
    public function site(Request $request)
    {
        $post = $request::post();
        $data = [
            'title' => $post['title'],
            'link' => $post['link'],
            'create_at' => time()
        ];
        Db::name('xf_sites')->insert($data);
        $this->success('新增成功');
    }

    /**
     * 删除站点
     */
    public function del(Request $request)
    {
        $id = $request::post('id');
        Db::name('xf_sites')->where('id', '=', $id)->update(['status' => 0]);
        $this->success('删除成功');
    }
}