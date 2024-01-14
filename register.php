<?php include "includes/dbconfig.php"; ?>
<?php
$message = $op='';
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];
    $now = time();
    if($username!='' || $password !=''){
        $q = $conn->query("SELECT * FROM `users` WHERE `username`='$username'");
        if($q->rowCount()){
            $message = '<div class="text-danger">نام کاربری تکراری است</div>';
        }
        else{
            $q = $conn->query("INSERT INTO `users` (`name`,`username`,`password`,`phone`,`email`,`address`,`created_at`) VALUES ('$name','$username','$password','$tel','$email','$address','$now')");
            if($q){
                $op = true;
                $message = '<div class="text-success">ثبت نام با موفقیت انجام شد</div><br><a href="login.php">ورود به سایت</a>';
            }
        }
    }
    else{
        $message = '<div class="text-danger">مقادیر خواسته شده را به دقت پر نمایید</div>';
    }
}
$title = 'ثبت نام';
?>
<?php include 'header.php';?>
            <section  class="biz-product-section ptb-40">
                <div class="text-right container col-md-7 alert alert-primary" id="fa">
                    <?=$message?>
                    <?php if($op==false){ ?>
                    <h4 class="text-right">ثبت نام</h4>
                        <form method="POST" action="">
                            <div class="form-group pad bala ">
                                <label for="">نام و نام خانوادگی</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group pad bala ">
                                <label for="">نام کاربری</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="form-group pad ">
                                <label for="">رمز عبور</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="form-group pad ">
                                <label for="">ایمیل</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group pad ">
                                <label for="">تلفن</label>
                                <input type="text" class="form-control" name="tel">
                            </div>
                            <div class="form-group pad ">
                                <label for="">آدرس</label>
                                <input type="address" class="form-control" name="address">
                            </div>
                            <div class="form-group pad paiin">
                                <button type="submit" class="btn btn-outline-primary" name="submit">ثبت نام</button>
                            </div>
                        </form>
    <?php } ?>
                </div>
            </section>
<?php include 'footer.php';?>