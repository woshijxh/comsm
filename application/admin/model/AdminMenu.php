<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/30
 * Time: 15:21
 */
namespace app\admin\model;

use \think\Model;

class AdminMenu extends Model
{

//    public function menulist2($menu){
//        $menus = array();
//        //先找出顶级栏目
//        foreach ($menu as $key => $val){
//            if ($val['pid'] == 0){
//                $menus[] = $val;
//            }
//        }
//
//        foreach ($menus as $key => $val) {
//            foreach ($menu as $k => $v){
//                if ($v['pid'] == $val['id']){
//                    $menus[$key]['list'][] = $v;
//                }
//            }
//        }
//        return $menus;
//    }

    /**
     * @param $menu
     * @param int $pid
     * @return array
     * @递归查询栏目
     */
    public function menulist($menu,$pid=0){
        $menus = array();
        foreach ($menu as $k=>$v){
            if($v['pid'] == $pid) {
                $v['list'] = $this->menulist($menu, $v['id']);
                if ($v['list'] == null) {
                    unset($v['list']);
                }
                $menus[] = $v;
            }
        }
        return $menus;
    }

}