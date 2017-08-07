<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>前台首页</title>
    <link rel="stylesheet" href="./static/bt/css/bootstrap.min.css">
</head>
<body>
    <div class="container" style="margin-top: 50px;">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <h2 class="panel-title">学生信息表</h2>
            </div>
            <div class="panel-body">
                <table class="table table-hover table-bordered">
                    <thead class="text-center>
                    <tr class="text-center">
                        <th class="text-center">编号</th>
                        <th class="text-center">姓名</th>
                        <th class="text-center">头像</th>
                        <th class="text-center">性别</th>
                        <th class="text-center">班级</th>
                        <th class="text-center">查看详细资料</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $k=> $v) :?>
<!--                         p2($v) -->
<!--                        Array-->
<!--                        (-->
<!--                        [sid] => 8-->
<!--                        [sname] => 陈真-->
<!--                        [birthday] => 2017-08-19-->
<!--                        [sex] => 男-->
<!--                        [hobby] => 篮球,乒乓球-->
<!--                        [profile] => upload/170802/5980ca1f8bb5b.jpg-->
<!--                        [gid] => 1-->
<!--                        [gname] => c83-->
<!--                        )-->
<!--                        Array-->
<!--                        (-->
<!--                        [sid] => 3-->
<!--                        [sname] => 王二麻子-->
<!--                        [birthday] => 2017-08-25-->
<!--                        [sex] => 女-->
<!--                        [hobby] => 足球-->
<!--                        [profile] => upload/170802/5980c38c7fb72.jpg-->
<!--                        [gid] => 3-->
<!--                        [gname] => c906666-->
<!--                        )-->
                        <tr>
                            <td class="text-center"><?php echo $k+1 ?></td>
                            <td class="text-center"><?php echo $v['sname']; ?></td>
                            <td class="text-center">
                                <img src="<?php echo $v['profile']; ?>" alt="" style="width: 60px;">
                            </td>
                            <td class="text-center"><?php echo $v['sex'];?></td>
                            <td class="text-center"><?php echo $v['gname'];?></td>
                            <td class="text-center">
                                <a href="?s=home/entry/show&sid=<?php echo $v['sid']; ?>">查看详细信息</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>