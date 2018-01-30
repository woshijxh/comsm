<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/29
 * Time: 14:32
 */
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;

class User extends Controller{

    public function _initialize()
    {
        #判断是否登录
        $admin_id = Session::get('name');
        if(!empty($admin_id)){
            $admin_name = Db::name('user')->where('admin_id',$admin_id)->find();
        }else{
            $this->redirect('/admin/login/index');
        }
    }
}