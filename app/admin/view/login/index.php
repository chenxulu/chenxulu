<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录页面</title>
    <script src="./static/js/jquery.min.js"></script>
    <link rel="stylesheet" href="./static/css/animate.min.css">
    <link rel="stylesheet" href="./static/bt/css/bootstrap.min.css">
</head>
<body>
<div class="container animated fadeInUpBig" style="margin-top: 20px;width: 40%">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">后台登录</h3>
        </div>
        <div class="panel-body">
            <form action="" method="post" role="form">

                <div class="form-group">
                    <label for="">用户名</label>
                    <input type="text" class="form-control" name="username" id="" required>
                </div>
                <div class="form-group">
                    <label for="">密码</label>
                    <input type="password" class="form-control" name="password" id="" required>
                </div>
                <div class="form-group">
                    <label for="">验证码</label>
                    <input type="text" class="form-control" name="captcha" id="" >
                    <br>
                    <img class="img-rounded" src="?s=admin/login/captcha" onclick="this.src=this.src+'&mt=' + Math.random()">
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="auto" id="">
                        7天免登陆
                    </label>
                </div>


                <button type="submit" class="btn btn-primary">登陆</button>
            </form>
        </div>
    </div>
</div>

</body>

</html>