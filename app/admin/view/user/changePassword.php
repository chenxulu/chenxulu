<?php include './view/admin/header.php' ?>
<div class="container" style="width: 60%;">
    <div class="row">
        <?php include './view/admin/left.php' ?>
        <div class="col-xs-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">修改密码</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post" role="form">

                        <div class="form-group">
                            <label for="">旧密码</label>
                            <input type="password" class="form-control" name="oldPassword" id="" required="">
                        </div>
                        <div class="form-group">
                            <label for="">新密码</label>
                            <input type="password" class="form-control" name="newPassword" required="" >
                        </div>
                        <div class="form-group">
                            <label for="">确认新密码</label>
                            <input type="password" class="form-control" name="confirmPassword" required>
                        </div>

                        <button type="submit" class="btn btn-primary">修改</button>
                        <a href="?s=admin/entry/index" role="button" class="btn btn-primary" >取消</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>