<?php
require_once "../includes/dbconfig.php";
require_once "../includes/jdf.php";
//check permission
if(!isset($_SESSION["permission"]) && $_SESSION["permission"] != 1) {
    header("location: ../index.php");
    exit();
}
//get all users pension
if(isset($_GET['userid'])){
    $userid = $_GET['userid'];
    $data = $conn->query("SELECT *,(SELECT `name` FROM `users` WHERE `ID`=`userid`) as `fullname` FROM `pension` WHERE `userid`='$userid' ORDER BY `reg_date` DESC");
}else {
    $data = $conn->query("SELECT *,SUM(`base`) as `base` ,SUM(`house`) as `house`,(SELECT `name` FROM `users` WHERE `ID`=`userid`) as `fullname` FROM `pension` GROUP BY `userid` ORDER BY `reg_date` DESC");
}
//delete
if(isset($_GET['delete'])){
    $userid = $_GET['deluser'];
    $pid = $_GET['delid'];
    $q = $conn->query("DELETE FROM `pension` WHERE `pid`='$pid' OR `userid`='$userid'");
    header('location:pension_list.php?op=ok');
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
            <h4>لیست حقوق</h4>
            <table class="table table-striped table-hover text-center">
                <?=@$message?>
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام و نام خانوادگی</th>
                    <th>پایه حقوق</th>
                    <th>حقوق مسکن</th>
                    <th>جمع کل حقوق</th>
                    <th>تاریخ</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                <?php $count=1; while($rows = $data->fetch()){ ?>
                    <tr>
                            <td><?=$count++?></td>
                            <td><a href="pension_list.php?userid=<?=$rows['userid']?>"><?=$rows['fullname']?></a></td>
                            <td><?=number_format($rows['base'])?></td>
                            <td><?=number_format($rows['house'])?></td>
                            <td><?=number_format($rows['base']+$rows['house'])?></td>
                            <td><?=jdate('H:i Y/m/d',$rows['reg_date'])?></td>
                            <td><a href="edit_pension.php?pid=<?=$rows['pid']?>&userid=<?=$rows['userid']?>"
                                   class="btn btn-xs btn-success">ویرایش</a>
                                <a href="<?=isset($_GET['userid'])?'pension_list.php?delete&delid='.$rows['pid']:'pension_list.php?delete&deluser='.$rows['userid']?>"
                                   class="btn btn-xs btn-danger">حذف</a>
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