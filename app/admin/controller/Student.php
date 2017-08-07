<?php
namespace app\admin\controller;


use houdunwang\core\Controller;
use houdunwang\model\Model;
use houdunwang\view\View;
use system\model\Grade;
use system\model\Material;
use system\model\Stu;

class Student extends Common{

    public function lists(){
//       $data = StudentModel::get();
        //上面的方法是获得当前表数据，即 stu表，但此时我们要获得内容需要 班级表与 学生表关联，所以此处不能再用此方法

        $data = Model::q("SELECT * FROM stu AS  s JOIN grade AS g ON s.gid=g.gid");

        return View::make()->with(compact('data'));
    }


    public function store(){
        //在添加 学生数据时    因为爱好的标签是 <input type="checkbox" value="篮球" name="hobby[]">   所以post提交的格式如下：
        if (IS_POST) {
//            p2($_POST);
//            Array
//            (
//                [sname] => 李四
//                [gid] => 2
//               [profile] => upload/170802/5980ca1f8bb5b.jpg
//               [sex] => 男
//               [birthday] => 2017-08-16
//               [hobby] => Array
//                         (
//                            [0] => 篮球
//                            [1] => 足球
//                            [2] => 乒乓球
//                          )
//
//)
            //为了实现数据能使用  save（）方法添加到数据库，需要单独把  格式为数组的 hobby这一项改为字符串
            if (isset($_POST['hobby'])) {
                $_POST['hobby'] = implode(',', $_POST['hobby']);
            }

//            Array
//            (
//                [sname] => 李四
//                [gid] => 2
//                [profile] => upload/170802/5980ca1f8bb5b.jpg
//                 [sex] => 男
//                 [birthday] => 2017-08-16
//                 [hobby] => 篮球,足球,乒乓球
//            )

                Stu::save($_POST);
            return $this->success('添加成功')->setRedirect('?s=admin/student/lists');
            }
            //使用添加方法时，要先获得已有的班级信息，因为在添加页面，要把这些信息遍历显示在    下拉列表中  供用户选择使用
            //获得班级信息
           $gradeData = Grade::get();
            //头像信息
            $materialData = Material::get();
        //在载入添加页面之前，把从班级班和素材表获得数据传过去，以便在添加页面使用
            return View::make()->with(compact('materialData', 'gradeData'));



    }


    public function remove(){
        //获得是要  删除哪一条数据
        $sid = $_GET['sid'];


        Stu::where("sid={$sid}")->destroy();

        return $this->success('删除成功')->setRedirect('?s=admin/student/lists');

    }

    //修改   的方法
     public function update(){
         //获知要修改的是哪一条
         $sid = $_GET['sid'];

         if(IS_POST){
            p2($_POST);
            exit;
             //此时我们提交的数据中  爱好hobby 依然还是数组，往数据库保存这条数据时，为了组合sql语句，还是要改为字符串
             if (isset($_POST['hobby'])) {
                 $_POST['hobby'] = implode(',', $_POST['hobby']);
             }
             Stu::where("sid={$sid}")->update($_POST);
             return $this->setRedirect('?s=admin/student/lists')->success('修改成功');

         }

         //获取当前点击“编辑”要修改的这条内容的所有旧数据
         $oldData = Stu::find($sid);
         //打印结果如下，因为我们往数据库（学生表）保存的时候，已经把爱好hobby这一项改为了字符串（数组时不能通过sql语句使用的）， 而我们修改某内容，想让其旧内容显示在修改页面时，字符串格式的 hobby这一项反而不方便使用（因为我们要让'李四' 的修改时页面中爱好 hobby这一项的 多选框依然默认选中 他添加时的选项  需要使用in_arry方法：  详见修改模板页面处）
//         Array
//         (
//             [sid] => 4
//             [sname] => 李四
//             [birthday] => 2017-08-16
//             [sex] => 男
//             [hobby] => 篮球,足球,乒乓球
//             [profile] => upload/170802/5980ca1f8bb5b.jpg
//             [gid] => 2
//)
//         p2($oldData);
         //单独把爱好这一项改回为数组
         $oldData['hobby'] = explode(',',$oldData['hobby']);

//         Array
//         (
//             [sid] => 4
//             [sname] => 李四
//             [birthday] => 2017-08-16
//             [sex] => 男
//             [hobby] => Array
//                        (
//                         [0] => 篮球
//                         [1] => 足球
//                         [2] => 乒乓球
//                         )
//
//            [profile] => upload/170802/5980ca1f8bb5b.jpg
//            [gid] => 2
//)
         //同样要获得班级信息，在修改模板中要使用
         $gradeData = Grade::get();
         //获得头像信息
         $materialData = Material::get();

         return View::make()->with(compact('oldData','gradeData','materialData'));




     }


}