<?php
require_once "../includes/dbconfig.php";
//check permission
if(!isset($_SESSION["permission"]) && $_SESSION["permission"] != 1) {
    header("location: ../index.php");
    exit();
}
//submit data
if(isset($_POST['btn_save'])) {
    $title = $_POST['title'];
    $type = $_POST['type'];
    $file = $_FILES['file']['name'];
    $now = time();
    $products = $conn->prepare("INSERT INTO `files` (`title`,`type`,`file`,`userid`,`created_at`) VALUES (?,?,?,?,?)");
    $products->bindParam(1,$title);
    $products->bindParam(2,$type);
    $products->bindParam(3,$file);
    $products->bindParam(4,$_SESSION['userid']);
    $products->bindParam(5,$now);
    if($products->execute()){
        move_uploaded_file($_FILES['file']['tmp_name'],'../uploads/'.$type.'/'.$_FILES['file']['name']);
        header('location:add.php?op=ok');
        exit();
    }
    else{
        header('location:add.php?op=error');
        exit();
    }
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
            <h4>افزودن محتوا</h4>
            <hr>
            <?=@$message?>
            <form action="" method="POST" enctype="multipart/form-data" >
                <div class="form-group row">
                    <div class="col-12">
                        <label>نوع فایل</label>
                        <select name="type" class="form-control" required>
                            <option>انتخاب کنید</option>
                            <option value="videos">فیلم</option>
                            <option value="photos">عکس</option>
                            <option value="files">فایل</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <label>عنوان</label>
                        <input type="text" class="form-control" name="title" placeholder="عنوان" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <label>فایل</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file">
                            <label class="custom-file-label text-center">انتخاب فایل</label>
                        </div>
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