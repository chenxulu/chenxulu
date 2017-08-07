<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人信息</title>
    <link rel="stylesheet" href="./static/bt/css/bootstrap.min.css">
</head>
<body>
    <div class="container" style="width: 50%; margin-top: 50px;">
<!--        Array(-->
<!--        [0] => Array(-->
<!--            [sid] => 3-->
<!--            [sname] => 王二麻子-->
<!--            [birthday] => 2017-08-25-->
<!--            [sex] => 女-->
<!--            [hobby] => 足球-->
<!--            [profile] => upload/170802/5980c38c7fb72.jpg-->
<!--            [gid] => 3-->
<!--            [gname] => c906666-->
<!--                     )-->
<!--        )-->
        <div class="panel panel-default">
            <div class="panel-heading" style="overflow: hidden;">
                <h3 class="panel-title" style="float: left;">欢迎来到  <span style="color:#ff6700;"><?php echo $data[0]['sname']?></span> 个人主页</h3>
                <span style="display:inline-block;float: right;">
                    <a href="./">返回首页</a>
                </span>

            </div>
            <div class="panel-body row ">
                <div class="col-xs-7">
                    <div>
                        <label for="inputID"><span style="color: #ff6700;">姓名 :</span> <?php echo $data[0]['sname'] ?></label>
                    </div>

                    <br>
                    <div >
                        <label for="inputID"><span style="color: #ff6700;">性别 :</span> <?php echo $data[0]['sex'] ?></label>
                    </div>
                    <br>
                    <div >
                        <label for="inputID"><span style="color: #ff6700;">生日 :</span> <?php echo $data[0]['birthday'] ?></label>
                    </div>
                    <br>
                    <div >
                        <label for="inputID"><span style="color: #ff6700;">班级 :</span> <?php echo $data[0]['gname'] ?></label>
                    </div>
                    <br>
                    <div >
                        <label for="inputID"><span style="color: #ff6700;">爱好 :</span> <?php echo $data[0]['hobby'] ?></label>
                    </div>

                </div>

               <div class="col-xs-5" >
                    <img src="<?php echo $data[0]['profile'] ?>" alt="" style="height: 200px;" >
               </div>

            </div>
        </div>
    </div>
</body>
</html>