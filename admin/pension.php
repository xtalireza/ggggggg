<?php
require_once "../includes/dbconfig.php";
//check permission
if(!isset($_SESSION["permission"]) && $_SESSION["permission"] != 1) {
    header("location: ../index.php");
    exit();
}
//pension
if(!isset($_GET['userid'])){
    header('location:users.php');
    exit();
}
$message='';
$userid = $_GET['userid'];
$user = $conn->query("SELECT * FROM `users` WHERE `ID`='$userid'");
$rows = $user->fetch();
//submit data
if(isset($_POST['btn_save'])) {
    $base = $_POST['base'];
    $house = $_POST['house'];
    $now = time();
    $data = $conn->prepare("INSERT INTO `pension` (`userid`,`base`,`house`,`reg_date`) VALUES (?,?,?,?)");
    $data->bindParam(1,$userid);
    $data->bindParam(2,$base);
    $data->bindParam(3,$house);
    $data->bindParam(4,$now);
    if($data->execute()){
        header('location:pension.php?op=ok');
        exit();
    }
    else{
        header('location:pension.php?op=error');
        exit();
    }
}
//edit data
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $edit = $conn->prepare("SELECT * FROM `pension` INNER JOIN `users` ON `users`.`ID`.`pension`.`userid` WHERE `pid`=?");
    $edit->bindParam(1,$id);
    $edit->execute();
    $erows = $edit->fetch();
}
//update data
if(isset($_POST['btn_update'])){
    $id = $_GET['edit'];
    $title = $_POST['title'];
    $pic = $erows['pic'];
    if(!empty($_FILES['pic']['name'])){
        $pic = time().'_'.$_FILES['pic']['name'];
    }
    $data = $conn->prepare("UPDATE `pension` SET `title`= ?,`pic`=? WHERE `pid`=?");
    $data->bindParam(1,$title);
    $data->bindParam(2,$pic);
    $data->bindParam(3,$id);
    if($data->execute()){
        if(!empty($_FILES['pic']['name'])){
            move_uploaded_file($_FILES['pic']['tmp_name'],'../img/cat/'.time().'_'.$_FILES['pic']['name']);
        }
        header('location:pension.php?op=ok');
        exit();
    }
    else{
        header('location:pension.php?op=error');
        exit();
    }
}
//delete
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $q = $conn->query("DELETE FROM `pension` WHERE `pid`='$id'");
    header('location:pension.php?op=ok');
    exit();
}
//message
if(isset($_GET['op'])){
    switch ($_GET['op']){
        case 'ok':
            $message = '<div class="alert alert-success">عملیات با موفقیت انجام شد.</div>';
            break;
        case 'error':
            $message = '<div class="alert alert-danger">مشکلی پیش آمده مجدد تلاش نمایید.</div>';
            break;
    }
}
?>
<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت</title>
    <!-- css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/adminlte.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <!-- js -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/adminlte.min.js"></script>
    <!-- js sweetalert2 -->
    <script src="js/sweetalert2@11.js"></script>
    <!-- icon -->
    <script src="js/all.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-2 admin-menu text-center bg-light py-3">
            <?php
            include("menu.php");
            ?>
        </div>
        <div class="col-10 admin-content text-right py-3">
            <h4>مدیریت حقوق</h4>
            <hr>
            <?=$message?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-3">
                        <label>نام و نام خانوادگی</label>
                        <input type="text" class="form-control" value="<?=@$rows['name']?>" readonly disabled>
                    </div>
                    <div class="col-3">
                        <label>نام کاربری</label>
                        <input type="text" class="form-control" value="<?=@$rows['username']?>" readonly disabled>
                    </div>
                    <div class="col-3">
                        <label>پایه حقوق</label>
                        <input type="text" class="form-control" name="base">
                    </div>
                    <div class="col-3">
                        <label>حقوق مسکن</label>
                        <input type="text" class="form-control" name="house">
                    </div>
                </div>
                <div class="text-left">
                    <button type="submit" class="btn btn-success" name="btn_save">ثبت</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>