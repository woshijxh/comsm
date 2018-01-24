<?php
/**
 * Created by PhpStorm.
 * User: jiaoxinghui
 * Date: 2018/1/24
 * Time: 15:20
 */
namespace app\admin\controller;

use think\Controller;

class Login extends Controller
{
//    public function  _initialize(){
//        if (session('uid')) {
//            $this->redirect('');
//        }
//    }

    public function index()
    {
        return $this->fetch('login/index');
    }





}