<?php


namespace app\admin\controller;


use houdunwang\view\View;
use system\model\user as UserModel;
class User extends Common{
    public function changePassword(){
        if(IS_POST){
            $post = $_POST;
//            p2($post);
            //修改密码时，先要正确输入  旧密码,拿数据库中当前用户的这条信息的密码和 用户刚输入的旧的密码对比一下
            //先从数据库中获得旧数据(需要的是数组中的 用户名  等于  当前session保存的用户名  的那条数据)
            $data = UserModel::where("username= '{$_SESSION['user']['username']}' ")->get();
            if(!password_verify($post['oldPassword'],$data[0]['password'])){
//                exit;
                return $this->error('旧密码错误');

            }

            //  如果 用户输入的两次新密码不一致
            if($post['newPassword'] != $post['confirmPassword']){
                return $this->error('新密码输入不一致');
            }
            //这时候才允许修改数据库  当条数据
            //但是新密码还是要哈希加密后再保存到数据库
            $pass = password_hash($post['newPassword'],PASSWORD_DEFAULT);
            $data = ['password'=>"$pass"];
             UserModel::where("username= '{$_SESSION['user']['username']}' ")->update($data);



            //修改密码后，要让用户重新登录，既然重新登录，就要先把保存的session文件删除掉
            session_unset();
            session_destroy();

            //调转到登录页面
            return $this->success('更改密码成功')->setRedirect('?s=admin/login/index');


        }


        return View::make();
    }
}