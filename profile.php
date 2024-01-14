<?php include "includes/dbconfig.php"; ?>
<?php
if(!isset($_SESSION['userid'])){
    header('location:login.php');
    exit();
}
$message ='';
$userid = $_SESSION['userid'];
$q = $conn->query("SELECT * FROM `users` WHERE `ID`='$userid'");
$rows = $q->fetch();
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];
    $q = $conn->query("UPDATE `users` SET `name`='$name',`password`='$password',`phone`='$tel',`email`='$email',`address`='$address' WHERE `ID`='$userid'");
    if($q){
        $message = '<div class="text-success">ویرایش با موفقیت انجام شد</div>';
            }
    else{
        $message = '<div class="text-danger">مشکلی پیش آمده مجدد تلاش نمایید</div>';
    }
}
$title = 'صفحه شخصی';
?>
<?php include 'header.php';?>
            <section  class="biz-product-section ptb-40">
                <div class="text-right container col-md-7 alert alert-primary" id="fa">
                    <?=$message?>
                    <h4 class="text-right">ویرایش اطلاعات</h4>
                        <form method="POST" action="">
                            <div class="form-group pad bala ">
                                <label for="">نام کاربری</label>
                                <input type="text" class="form-control" name="username" value="<?=$rows['username']?>" disabled readonly>
                            </div>
                            <div class="form-group pad bala ">
                                <label for="">نام و نام خانوادگی</label>
                                <input type="text" class="form-control" name="name" value="<?=$rows['name']?>" required>
                            </div>
                            <div class="form-group pad ">
                                <label for="">رمز عبور</label>
                                <input type="password" class="form-control" name="password" value="<?=$rows['password']?>" required>
                            </div>
                            <div class="form-group pad ">
                                <label for="">ایمیل</label>
                                <input type="email" class="form-control" name="email" value="<?=$rows['email']?>" >
                            </div>
                            <div class="form-group pad ">
                                <label for="">تلفن</label>
                                <input type="text" class="form-control" name="tel" value="<?=$rows['phone']?>">
                            </div>
                            <div class="form-group pad ">
                                <label for="">آدرس</label>
                                <input type="address" class="form-control" value="<?=$rows['address']?>" name="address">
                            </div>
                            <div class="form-group pad paiin">
                                <button type="submit" class="btn btn-outline-primary" name="submit">ویرایش</button>
                            </div>
                        </form>
                </div>
            </section>
<?php include 'footer.php';?>