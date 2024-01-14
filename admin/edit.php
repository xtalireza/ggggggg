<?php
require_once "../includes/dbconfig.php";
//check permission
if(!isset($_SESSION["permission"]) && $_SESSION["permission"] != 1) {
    header("location: ../index.php");
    exit();
}
if(!isset($_GET['id'])) {
    header('location:add.php');
    exit();
}
$id = $_GET['id'];
//data
$data = $conn->query("SELECT * FROM `files` WHERE `id`='$id'");
$rows = $data->fetch();
//submit data
if(isset($_POST['btn_save'])) {
    $title = $_POST['title'];
    $type = $_POST['type'];
    $file = $rows['file'];
    if(!empty($_FILES['file']['name']))
    $file = $_FILES['file']['name'];
    $q = $conn->prepare("UPDATE `files` SET `title`=?,`type`=?,`file`=? WHERE `id`=?");
    $q->bindParam(1,$title);
    $q->bindParam(2,$type);
    $q->bindParam(3,$file);
    $q->bindParam(4,$id);
    if($q->execute()){
        if(!empty($_FILES['file']['name']))
        move_uploaded_file($_FILES['file']['tmp_name'],'../uploads/'.$type.'/'.$_FILES['file']['name']);
        header('location:list.php?ok');
        exit();
    }
    else{
        header('location:edit.php?error');
        exit();
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
            <h4>ویرایش محتوا</h4>
            <hr>
            <?php
            if (isset($errors) && count($errors) > 0) {
                foreach ($errors as $error) {
                    echo '<div class="alert alert-danger text-center">' . $error . '</div>';
                }
            }
            ?>
            <form action="" method="POST" enctype="multipart/form-data" >
                <div class="form-group row">
                    <div class="col-12">
                        <label>گروه</label>
                        <select name="type" class="form-control" required>
                            <option value="">انتخاب کنید</option>
                            <option <?=@$rows['type']=='videos'?'selected':''?> value="videos">فیلم</option>
                            <option <?=@$rows['type']=='photos'?'selected':''?> value="photos">عکس</option>
                            <option <?=@$rows['type']=='files'?'selected':''?> value="files">فایل</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <label>عنوان</label>
                        <input type="text" class="form-control" name="title" required autocomplete="off" value="<?=$rows['title']?>">
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
                <div class="form-group row">
                    <?php if(@$rows['type']=='videos'){ ?>
                        <video  controls>
                            <source src="../uploads/videos/<?=$rows['file']?>" type="video/mp4">
                            <source src="../uploads/videos/<?=$rows['file']?>" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    <?php }if(@$rows['type']=='photos'){ ?>
                        <img class="img-thumbnail" src="../uploads/photos/<?=$rows['file']?>">
                    <?php }if(@$rows['type']=='files'){ ?>
                        <a href="../uploads/files/<?=$rows['file']?>">دانلود</a>
                    <?php } ?>
                </div>
                <div class="text-left">
                    <button type="submit" class="btn btn-primary" name="btn_save">ویرایش</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>