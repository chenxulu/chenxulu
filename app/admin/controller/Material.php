<?php


namespace app\admin\controller;


use houdunwang\core\Controller;
//我们在类中要使用的文章表material 的扩展模型类Material刚好与 文章material的控制器（也是类，名为Material）
//同名，以防混淆，所以给扩展模型类  起了别名 .

use houdunwang\view\View;
use system\model\Material as MaterialModel;

class Material extends Common{
    public function lists(){
        $data = MaterialModel::get();
        return View::make()->with(compact('data'));
    }

    //先封装一个文件上传的 “配置方法” 为下面的store方法实现文件真正上传做准备
    private function upload() {
        //创建上传目录（当前的upload目录，那就是在public目录下）
        $dir = 'upload/' . date( 'ymd' );
        //   短路  ‘或’写法，左边不成立，即文件目录不存在时  就执行右边  递归创建该目录
        is_dir( $dir ) || mkdir( $dir, 0777, true );
        //设置上传目录
        $storage = new \Upload\Storage\FileSystem( $dir );
        $file    = new \Upload\File( 'upload', $storage );
        //设置上传文件名字唯一
        $new_filename = uniqid();
        $file->setName( $new_filename );

        //限定允许上传的类型和文件大小
        $file->addValidations( array(
            // 下面的数组中是允许上传的文件类型，可以自己添加项允许上传的文件类型
            new \Upload\Validation\Mimetype( [ 'image/png', 'image/gif', 'image/jpeg' ] ),
            //限定最大允许上传文件为5M（自己更改）
            new \Upload\Validation\Size( '5M' )
        ) );

        //组合数组，这个数组就是文件上传成功后返回的数组，我们可以把想获得的信息添加到数组中，那么在上传后就可以返回而获得
        $data = array(
            'name'       => $file->getNameWithExtension(),
            'extension'  => $file->getExtension(),
            'mime'       => $file->getMimetype(),
            'size'       => $file->getSize(),
            'md5'        => $file->getMd5(),
            'dimensions' => $file->getDimensions(),
            //自己组合的上传之后的完整路径，在显示页面的img标签的src属性中echo 出这个path的值，就可以让图片显示出来
            'path'       => $dir . '/' . $file->getNameWithExtension(),
        );


        //因为我们加载了 ‘错误提示类’，所以这里我们不需要再自己写
        try {
            // Success!
            $file->upload();

            return $data;
        }catch ( \Exception $e ) {
            // Fail!
            $errors = $file->getErrors();
            foreach ( $errors as $e ) {
                throw new \Exception( $e );
            }

        }
    }


    public function store(){
        if(IS_POST){
            //$info是上传时的返回信息（其中的path是自己添加才有的返回值，表示文件上传完整路径）
            $info = $this->upload();
//            p($info);
//            Array
//            (
//                [name] => 5980be1ddc0a5.jpg
//                [extension] => jpg
//                [mime] => image/jpeg
//                [size] => 7497
//                [md5] => 6dc76e15a705b7e88f0b65800f4d4e47
//                [dimensions] => Array
//                    (
//                        [width] => 121
//                        [height] => 140
//                    )
//
//                [path] => upload/170802/5980be1ddc0a5.jpg
//)
             //把上传之后的需要的返回值保存到数据库（素材表中），也就是上传完整路径，因为我们要把其循环遍历显示在列表中，同时附上一个当前的时间戳，用来记录上传时间
            $data = [
                'path' => $info['path'],
                'create_time' => time()
            ];
            MaterialModel::save($data);
            return $this->success('上传成功')->setRedirect('?s=admin/material/lists');

        }

        return View::make();
    }


    public function remove(){
        //获得是要  删除哪一条数据
        $mid = $_GET['mid'];
        //获得数据库（素材表）中这条数据的值 ，其中含有  文件的完整路径，我们要依据这个路径去删除文件
        $data =  MaterialModel::find($mid);

        //删除文件  (文件存在就删除该文件)
        is_file($data['path']) && unlink($data['path']);
        //删除数据库信息，因为执行完  的删除文件，只是删除了upload文件夹下的实实在在的文件，但数据库中的该文件信息还在（包括文件名、创建时间），依然会显示在列表中，所以还得把数据库该条数据删除
        MaterialModel::where("mid={$mid}")->destroy();

        return $this->success('删除成功')->setRedirect('?s=admin/material/lists');

    }







}