<?php include './view/admin/header.php' ?>
<div class="container">
    <div class="row">
        <?php include './view/admin/left.php' ?>
        <div class="col-xs-9">
            <a href="?s=admin/student/lists" class="btn btn-primary">列表</a>
            <a href="?s=admin/student/store" class="btn btn-default">添加</a>
            <hr>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>头像</th>
                    <th>所属班级</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ( $data as $k => $v ): ?>
               <!-- 此处打印   $v的结果如下 -->
<!--                    Array-->
<!--                    (-->
<!--                    [sid] => 2-->
<!--                    [sname] => 李四-->
<!--                    [birthday] => 1993-07-23-->
<!--                    [sex] => 女-->
<!--                    [hobby] => 足球-->
<!--                    [profile] => upload/170801/5980918c1b05a.jpg-->
<!--                    [gid] => 2-->
<!--                    [gname] => c81-->
<!--                    )-->
                    <tr>
                        <td><?php echo $k + 1 ?></td>
                        <td><?php echo $v['sname'] ?></td>
                        <td><?php echo $v['sex'] ?></td>
                        <td>
                            <img src="<?php echo $v['profile'] ?>" width="80" >
                        </td>
                        <td><?php echo $v['gname'] ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="...">
                                <a href="?s=admin/student/update&sid=<?php echo $v['sid'] ?>"
                                   class="btn btn-xs btn-info">编辑</a>
                                <a href="javascript:if(confirm('确定删除吗？')) location.href='?s=admin/student/remove&sid=<?php echo $v['sid'] ?>';"
                                   class="btn btn-xs btn-danger">删除</a>
                            </div>
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