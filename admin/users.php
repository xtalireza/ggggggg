<?php
require_once "../includes/dbconfig.php";
//check permission
if(!isset($_SESSION["permission"]) && $_SESSION["permission"] != 1) {
    header("location: ../index.php");
    exit();
}
//get all users
$data = $conn->query("SELECT *,(SELECT SUM(`base`+`house`) FROM `pension` WHERE `userid`=`ID`) as `total` FROM `users`  ORDER BY `created_at` DESC");
//delete
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $q = $conn->query("DELETE FROM `users` WHERE `ID`='$id'");
    header('location:users.php?op=ok');
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
            <h4>کل کاربران</h4>
            <table class="table table-striped table-hover text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام و نام خانوادگی</th>
                    <th>شماره تلفن</th>
                    <th>جمع کل حقوق</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                <?php $count=1; while($rows = $data->fetch()){ ?>
                    <tr>
                            <td><?=$count++?></td>
                            <td><?=$rows['name']?></td>
                            <td><?=$rows['phone']?></td>
                            <td><?=number_format($rows['total'])?></td>
                            <td>
                                <?=$rows['permission']==1?'-':'<a href="pension.php?userid='.$rows['ID'].'"
                                   class="btn btn-xs btn-primary">ثبت حقوق</a>'?>
                                <?=$rows['permission']==1?'-':'<a href="users.php?delete='.$rows['ID'].'"
                                   class="btn btn-xs btn-danger">حذف</a>'?>
                            </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>