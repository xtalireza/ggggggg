<?php
include "includes/dbconfig.php";
include "includes/jdf.php";
//check user login
if(!isset($_SESSION['userid'])){
    header('location:login.php');
    exit();
}
$message ='';
$userid = $_SESSION['userid'];
$data = $conn->query("SELECT * FROM `files` WHERE `userid`='$userid'");
//submit data
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $type = $_POST['type'];
    $file = $_FILES['file']['name'];
    $now = time();
    $q = $conn->query("INSERT INTO `files` (`title`,`userid`,`type`,`file`,`created_at`) VALUES ('$title','$userid','$type','$file','$now')");
            if($q){
                move_uploaded_file($_FILES['file']['tmp_name'],'uploads/'.$type.'/'.$file);
                header('location:upload.php?op=ok');
                exit();
            }
            else{
                header('location:upload.php?op=error');
                exit();
            }
}
//get edit data
if(isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    $edit = $conn->query("SELECT * FROM `files` WHERE `id`='$id' AND `userid`='$userid'");
    $rows = $edit->fetch();
}
//update data
if(isset($_POST['edit'])){
    $title = $_POST['title'];
    $type = $_POST['type'];
    $file = $rows['file'];
    if(!empty($_FILES['file']['name']))
    $file = $_FILES['file']['name'];
    $q = $conn->query("UPDATE `files` SET `title`='$title',`type`='$type',`file`='$file' WHERE `id`='$id' AND `userid`='$userid'");
    if($q){
        if(!empty($_FILES['file']['name']))
            move_uploaded_file($_FILES['file']['tmp_name'],'uploads/'.$type.'/'.$file);
            header('location:upload.php?op=ok');
            exit();
    }
    else{
        header('location:upload.php?op=error');
        exit();
    }
}
//delete data
if(isset($_GET['del'])){
    $id = $_GET['del'];
    $q = $conn->query("DELETE FROM `files` WHERE `id`='$id' AND `userid`='$userid'");
    if($q){
        header('location:upload.php?op=ok');
        exit();
    }
    else{
        header('location:upload.php?op=error');
        exit();
    }

}
if(isset($_GET['op'])){
    if($_GET['op']=='ok'){
        $message = '<div class="text-success">عملیات با موفقیت انجام شد</div>';
    }
    else{
        $message = '<div class="text-danger">مشکلی پیش آمده مجدد تلاش نمایید</div>';
    }
}
$title = 'آپلود فایل';
?>
<?php include 'header.php';?>
            <section  class="biz-product-section ptb-40">
                <div class="text-right container col-md-7 alert alert-primary" id="fa">
                    <?=$message?>
                    <h4 class="text-right">آپلود فایل</h4>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group pad bala ">
                                <label for="">عنوان</label>
                                <input type="text" class="form-control" name="title" value="<?=@$rows['title']?>" required>
                            </div>
                            <div class="form-group pad bala ">
                                <label for="">نوع فایل</label>
                                <select name="type" class="form-control" required>
                                    <option>انتخاب کنید</option>
                                    <option <?=@$rows['type']=='videos'?'selected':''?> value="videos">فیلم</option>
                                    <option <?=@$rows['type']=='photos'?'selected':''?> value="photos">عکس</option>
                                    <option <?=@$rows['type']=='files'?'selected':''?> value="files">فایل</option>
                                </select>
                            </div>
                            <div class="form-group pad ">
                                <label for="">فایل</label>
                                <input type="file" class="form-control" name="file">
                            </div>
                            <div class="form-group pad paiin">
                                <?php if(isset($_GET['edit'])){ ?>
                                    <button type="submit" class="btn btn-primary" name="edit">ویرایش</button>
                                <?php }else{ ?>
                                    <button type="submit" class="btn btn-success" name="submit">ارسال</button>
                                <?php } ?>
                            </div>
                        </form>
                </div>
            </section>
            <hr>
            <section  class="biz-product-section ptb-40">
                <div class="text-right container col-md-7 alert alert-primary" id="fa">
                    <h4 class="text-right">لیست فایل ها</h4>
                    <table class="table table-striped">
                        <tr>
                            <td>#</td>
                            <td>عنوان</td>
                            <td>نوع</td>
                            <td>تاریخ</td>
                            <td class="text-center">مدیریت</td>
                        </tr>
                        <?php $i=1; while($rows = $data->fetch()){ ?>
                            <tr>
                                <td><?=$i++?></td>
                                <td><?=$rows['title']?></td>
                                <td><?php
                                    switch($rows['type']){
                                        case 'videos':
                                            echo 'فیلم';
                                            break;
                                        case 'photos':
                                            echo 'تصویر';
                                            break;
                                        case 'files':
                                            echo 'فایل';
                                            break;
                                    }?></td>
                                <td><?=jdate('Y/m/d',$rows['created_at'])?></td>
                                <td class="text-center">
                                    <a href="upload.php?del=<?=$rows['id']?>" class="btn btn-sm btn-danger">حذف</a>
                                    <a href="upload.php?edit=<?=$rows['id']?>" class="btn btn-sm btn-primary">ویرایش</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </section>
<?php include 'footer.php';?>