<?php


namespace app\controller;


use controller\BaseApi;
use think\Db;
use think\facade\Cache;
use think\facade\Log;
use think\facade\Request;
use think\facade\Session;

class User extends BaseApi
{

    /**
     * 登陆
     */
    public function login(Request $request)
    {
        $post = $request::post();
        $account = trim($post['account']);
        $password = trim($post['password']);
        $user = \think\facade\Db::name('xf_user')->where('account', '=', $account)->find();
        if (!$user) $this->error('账号不存在');
        if (md5($password) != $user['password']) $this->error('密码错误');
        Cache::set('admin_user', $user);
        $this->success('登陆成功', $user);
    }


    /**
     * 保存个人信息
     */
    public function userInfo(Request $request)
    {
        $userId = Cache::get('admin_user')['id'];
        if ($request::isGet()) {
            $user = \think\facade\Db::name('xf_user')->where('id', '=', $userId)->find();
            $this->success('请求成功', $user);
        } else {
            $post = $request::post();
            $data = [
                'username' => $post['username'],
                'age' => $post['age'],
                'address' => $post['address'],
                'hobby' => $post['hobby'],
                'qq' => $post['qq'],
                'wechat' => $post['weixin'],
                'avatar' => $post['avatar'],
                'account' => 'admin',
                'password' => md5(123456),
                'create_at' => time(),
                'about' => $post['about']
            ];
            $user = \think\facade\Db::name('xf_user')->where('id', '=', $userId)->find();
            if ($user) {
                \think\facade\Db::name('xf_user')->where('id', '=', $userId)->update($data);
                $this->success('信息保存成功');
            } else {
                \think\facade\Db::name('xf_user')->insert($data);
                $this->success('信息保存成功');
            }
        }
    }

    /**
     * 修改密码
     */
    public function changePwd(Request $request)
    {
        $post = $request::post();
        $userId = Cache::get('admin_user')['id'];
        $user = \think\facade\Db::name('xf_user')->where('id', '=', $userId)->find();
        if (md5($post['old_password']) != $user['password']) $this->error('旧密码不正确');
        \think\facade\Db::name('xf_user')->where('id', '=', $userId)->update([
            'password' => md5($post['new_password'])
        ]);
        $this->success('密码修改成功');
    }


    /**
     * 推出登陆
     */
    public function logout()
    {
        Cache::delete('admin_user');
        $this->success('推出登陆成功');
    }




}