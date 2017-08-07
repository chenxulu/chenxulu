<?php
namespace app\home\controller;
use houdunwang\core\Controller;
use houdunwang\model\Model;
use houdunwang\view\View;

class Entry extends Controller{
    //显示前台首页的方法
    public function index(){
        //前台首页 需要的数据   来自班级表 和 学生表
        $data = Model::q("SELECT * FROM stu AS s JOIN grade AS g ON s.gid = g.gid");
         return View::make()->with(compact('data'));
    }
    //前台中显示某个人详情信息的方法  同样需要将学生表和班级表关联，而且要加 where条件
    public function show(){
        $data = Model::q("SELECT * FROM stu AS s JOIN grade AS g ON s.gid = g.gid WHERE sid={$_GET['sid']}");
        return View::make()->with(compact('data'));

    }
}

?>