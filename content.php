<?php
include "includes/dbconfig.php";
include "includes/jdf.php";

if(!isset($_GET['id'])){
    header('location:index.php');
    exit();
}

$id = intval($_GET['id']);
$q = $conn->query("SELECT * FROM `files` WHERE `id`='$id'");
$rows = $q->fetch();

$title = $rows['title'];
?>
<?php include 'header.php'; ?>
<section id="discount" class="biz-product-section ptb-40">
    <div class="container col-md-10 alert alert-primary">
        <div class="container text-center col-4">
            <div>
                <h4><?=$rows['title']?></h4>
            </div>
            <?php if($rows['type']=='videos'){ ?>
                <video  controls>
                    <source src="uploads/videos/<?=$rows['file']?>" type="video/mp4">
                    <source src="uploads/videos/<?=$rows['file']?>" type="video/ogg">
                    Your browser does not support the video tag.
                </video>
            <?php }if($rows['type']=='photos'){ ?>
                <img class="img-thumbnail img-fluid" src="uploads/photos/<?=$rows['file']?>">
            <?php }if($rows['type']=='files'){ ?>
                <i class="fa fa-download"></i> <a href="../uploads/files/<?=$rows['file']?>">دانلود</a>
            <?php } ?>
        </div>

        </div>
</section>
<?php include 'footer.php'; ?>