<?php include "includes/dbconfig.php"; ?>
<?php
$message='';
if(isset($_POST['submit'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $query = $conn->query("SELECT * FROM `users` WHERE `username`='$user' AND `password`='$pass'");
    $rows = $query->fetch();
    if($query->rowCount()){
        $_SESSION['user']=$user;
        $_SESSION['userid'] = $rows['ID'];
        $_SESSION['permission'] = $rows['permission'];
        $_SESSION['fullname'] = $rows['name'];
        header('location:index.php');
    }
    else{
        $message = '<div class="text-danger text-center">نام کاربری یا پسورد اشتباه هست</div>';
    }
}
$title = 'ورود به سایت';
?>
<?php include 'header.php';?>
            <section class="biz-product-section ptb-40">
                <div class="text-right container col-md-7 alert alert-primary" id="fa">
                    <?=$message?>
                    <h5 class="text-right">ورود</h5>
                    <form class="form-signin" method="post" action="">
                        <h6 class="form-signin-heading">اطلاعات خواسته شده وارد نمایید</h6>
                        <div style="color:#f00"></div>
                        <div class="form-group pad bala ">
                            <label for="">نام کاربری:</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="form-group pad bala ">
                            <label for="">پسورد:</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <br>
                        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">ورود</button>
                    </form>
                </div>
            </section>
<?php include 'footer.php';?>