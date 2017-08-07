<?php
namespace app\admin\controller;
use houdunwang\core\Controller;
use houdunwang\view\View;


//后台的页面，在用户没有登录的时候，不能让其访问任何页面，也就是不能调用admin\controller里面的任何类，也就是当在地址栏输入admin/entry/index 等，都不能出现任何后台的页面，而是跳到后台的登录页，所以在调用后台的admin里面的控制器里面的任何方法时，都要加个判断，就是用户是否已经登录（用  是否存在session文件来作为判断依据），既然所有的方法都需要判断，那么就把判断是否登录的方法放在父类的构造方法中，当使用到子类时，父级的构造方法就会自动执行，此时的父类不再是 框架模块目录houdunwang\core\Controller,而是新建的同目录下的Common，让所有的控制器类（Entry  Grade  Material 等）都继承这个Common父类（只有负责登录的类 Longin不需要继承这个类，调用Login类里的index方法去 去登陆页，不要判断有没有session文件），再让Common 继承核心目录里面的Controller，这样所有类依然可以使用Controller里面的 success方法和setRedirect方法



class Entry extends Common{
    public function index(){

        return View::make();
    }
}














?>