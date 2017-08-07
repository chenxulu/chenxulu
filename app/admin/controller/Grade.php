<?php


namespace app\admin\controller;


use houdunwang\core\Controller;
use houdunwang\model\Model;
use houdunwang\view\View;
use system\model\Grade as  GreadeMode;

class Grade extends Common{
    //显示班级列表的方法
    public function lists(){
        $data = GreadeMode::get();
        return View::make()->with(compact('data'));
    }

    //添加数据  的方法
    public function store(){
        if(IS_POST){
            GreadeMode::save($_POST);
            return $this->success('添加成功')->setRedirect('?s=admin/grade/lists');
        }
        return View::make();
    }

    //删除数据  的方法
    public function remove(){
        $gid = $_GET['gid'];
         GreadeMode::where("gid={$gid}")->destroy();
        return $this->success('删除成功')->setRedirect('?s=admin/grade/lists');
    }

    //修改（编辑）  某条数据的方法
    public function update(){
        //获得a标签的传参，键名为gid的值代表的是 要修改的那条数据的 主键值
        $gid = $_GET['gid'];
        if(IS_POST){
            GreadeMode::where("gid={$gid}")->update($_POST);
            return $this->success('修改成功')->setRedirect('?s=admin/grade/lists');
        }
        //获得旧数据
        $oldData = GreadeMode::find($gid);

        return View::make()->with(compact('oldData'));
    }

}