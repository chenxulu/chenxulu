<?php


namespace app\admin\controller;
use houdunwang\core\Controller;


class Common extends Controller{
    public function __construct(){
        //当session['user']不存在时，就调用go 函数实现页面跳转到登录页面，go函数封装在 core的 function.php
        if(!isset($_SESSION['user'])){
            go('?s=admin/login/index');
        }
    }
}