<?php


namespace app\admin\controller;


use houdunwang\core\Controller;
use houdunwang\view\View;
use system\model\User;
use Gregwar\Captcha\CaptchaBuilder;
class Login extends Controller{
    //登录的用户名和密码是预先存入数据库user表的，后台的网站不能有注册
    //  使用哈希函数将密码加密后再保存到 数据库
    public function index(){
//        $password = password_hash('123',PASSWORD_DEFAULT);
//        echo $password;
//        exit;
//        $2y$10$QDBlcaE6OXEHUi5EG4yzZ.hEX/hI.613.20MgO.i0DF7BEUFbMSv.
        if (IS_POST) {
            //先判断验证码是否正确，验证码错误就不再往下执行
            $post = $_POST;
//            p2($post);
//            Array
//                (
//                    [username] => 张三
//                    [password] => 789
//                    [captcha] => bba
//                    [auto] => on
//                )
            // 验证码错误
            if ($post['captcha'] != $_SESSION['captcha']) {
                return $this->error('验证码错误');
            }

            //再判断用户名是否正确（就是看一下 数据库中有没有用户刚刚提交的这个用户名，有就说明正确）
            $data = User::where("username = '{$post['username']}'")->get();
//            p2($data);exit;
//            Array
//            (
//                [0] => Array
//                    (
//                        [uid] => 1
//                        [username] => 陈绪路
//                        [password] => $2y$10$FIoHYZJcEIOarzDoLQmUdOXxLTKvcMdwp6JOzqXy7o.3qo3ImZysa
//                    )
//
//            )
            if (!$data) {
                return $this->error('该用户名不存在');
            }

            //检测密码是否正确

            if (!password_verify($post['password'], $data[0]['password'])) {
                return $this->error('密码错误');
            }

            //判断用户是否点击了‘7天免登录’，判断依据是 post提交的数组中是否含有$post['auto']
            //  <input type="checkbox" name="auto" id="">7天免登陆
            if(isset($post['auto'])){
                setcookie(session_name(),session_id(),time()+7*24*366,'/');
            }else{
                setcookie(session_name(),session_id(),0,'/');
            }

            //保存session
            $_SESSION['user'] = [
                'uid'=> $data[0]['uid'],
                'username'=> $data[0]['username']
            ];

            return $this->success('登录成功')->setRedirect('?s=admin/entry/index');

        }


        return View::make();
    }
    //生成验证码 的方法
    public function captcha(){

      	$str     = substr( md5( microtime( true ) ), 0, 3 );
        $builder = new CaptchaBuilder($str);
        $builder->build();
        header('Content-type: image/jpeg');
        $builder->output();
        //将生成的验证码保存到session文件，用以和用户登录时输入的验证码比对
        $_SESSION['captcha'] = $builder->getPhrase();
    }

    //实现退出登录的方法

    public function out(){
        //删除session变量
        session_unset();
        //删除session文件
        session_destroy();

        return $this->success('退出成功')->setRedirect('?s=admin/login/index');
    }

















}