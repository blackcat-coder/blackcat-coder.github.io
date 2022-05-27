<?php


namespace app\controller;


use controller\BaseApi;
use think\facade\Db;

class Conf extends BaseApi
{


    /**
     * 新增配置
     */
    public function index(\think\facade\Request $request)
    {
        if ($request::isPost()) {
            $post = $request::post();
            $confs = Db::name('xf_conf')->where('id', '=',1)->find();
            $data = [
                'web_title' => $post['title'],
                'web_keyword' => $post['keyword'],
                'web_desc' => $post['desc'],
                'web_logo' => $post['logo'],
                'wangyi' => $post['wangyi'],
            ];
            if ($confs) {
                Db::name('xf_conf')->where('id', '=',1)->update($data);
            } else {
                Db::name('xf_conf')->insert($data);
            }
            $this->success('信息更新成功');
        } else {
            $confs = Db::name('xf_conf')->where('id', '=',1)->find();
            $this->success('获取成功', $confs);
        }

    }
}