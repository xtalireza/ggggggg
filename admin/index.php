<?php
require_once "../includes/dbconfig.php";
//check permission
if(!isset($_SESSION["permission"]) && $_SESSION["permission"] != 1) {
header("location: ../index.php");
    exit();
}

//count of users
$allusers = $conn->query("SELECT * FROM users");
$total_user = $allusers->rowCount();

//count of videos
$videos = $conn->query("SELECT * FROM files WHERE `type`='videos'");
$total_video = $videos->rowCount();

//count of photos
$photos = $conn->query("SELECT * FROM files WHERE `type`='photos'");
$total_photo = $photos->rowCount();

//count of files
$files = $conn->query("SELECT * FROM files WHERE `type`='files'");
$total_file = $files->rowCount();
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
    <!-- icon -->
    <script src="js/all.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-2 admin-menu text-center bg-light py-3">
            <?php
            include ("menu.php");
            ?>
        </div>
        <div class="col-10 admin-content text-right py-3">
            <h4>داشبورد کاربری</h4>
            <span class="text-muted">به پنل مدیریت خوش آمدید</span>
            <hr>
            <div class="row pb-4">
                <div class="col-3">
                    <div class="card bg-gradient-danger shadow-sm">
                        <div class="card-body text-center">
                            <p class="text-right">تعداد کاربران</p>
                            <h4 class="font-weight-bold"><?=$total_user?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card bg-gradient-primary shadow-sm">
                        <div class="card-body text-center">
                            <p class="text-right">تعداد ویدئو ها</p>
                            <h4 class="font-weight-bold"><?=$total_video?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card bg-gradient-warning shadow-sm">
                        <div class="card-body text-center">
                            <p class="text-right">تعداد تصاویر</p>
                            <h4 class="font-weight-bold"><?=$total_photo?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card bg-gradient-success shadow-sm">
                        <div class="card-body text-center">
                            <p class="text-right">تعداد فایل ها</p>
                            <h4 class="font-weight-bold"><?=$total_file?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>