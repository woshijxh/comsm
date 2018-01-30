<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/29
 * Time: 14:07
 */
namespace app\admin\controller;

use think\Controller;
use app\admin\controller\User;
use app\admin\model\AdminMenu;

class Index extends User
{
    public function index()
    {
        $menumodel = new AdminMenu();
        $menu = $menumodel->order('orders asc')->select()->toArray();
        $menus = $menumodel->menulist($menu);
        //print_r($menus);die;
        $this->assign('menus',$menus);
        return $this->fetch();
    }
}