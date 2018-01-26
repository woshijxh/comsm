<?php
/**
 * Created by PhpStorm.
 * User: jiaoxinghui
 * Date: 2018/1/24
 * Time: 15:20
 */
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Session;
use think\Validate;
use think\Db;

class Login extends Controller
{

//    public function  _initialize(){
//        if (session('uid')) {
//            $this->redirect('');
//        }
//    }

    /**
     * 用户登录
     * @return mixed|void
     */
    public function index()
    {
        if(Session::has('username') == false){
            #是否登录
            if (Request::instance()->isPost()) {
                $post = $this->request->post();
                #验证数据合法性
                $validate = new Validate([
                    ['username','require|max:25','用户名不能为空|用户名最多不可超过25个字符'],
                    ['password','require|max:20','密码不能为空|密码长度超出'],
                    ['captcha','require|captcha','验证码不能为空|验证码不正确'],
                ]);
                if(!$validate->check($post)){
                    return $this->error('提交失败：' . $validate->getError());
                }
                #判断用户名是否存在
                $username = Db::name('comsm_admin')->where('username',$post['name'])->find();
                if(empty($username)){
                    return $this->error('用户不存在!');
                }else{
                    $post['password'] = user_password($post['password']);
                    if($post['password'] !== $username['password']){
                        return $this->error('密码错误!');
                    }else{
                        Session::set('name',$username['admin_id'],7200);
                        #记录登录ip和登录时间
                        Db::name('comsm_admin')->where('admin_id',$username['admin_id'])->update(['login_ip' => $this->request->ip(), 'login_time' => time()]);
                        return $this->success('登录成功,正在跳转...','admin/index/index');
                    }
                }
            }else{
                return $this->fetch('login/index');
            }

        }

    }





}