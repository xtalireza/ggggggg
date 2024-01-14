<?php include "includes/dbconfig.php"; ?>
<?php
//videos
$videos = $conn->query("SELECT * FROM `files` WHERE `type`='videos'");
//photos
$photos = $conn->query("SELECT * FROM `files` WHERE `type`='photos'");
//files
$files = $conn->query("SELECT * FROM `files` WHERE `type`='files'");

?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>نمایش فایل</title>
    <link rel="icon" href="img/favicon.png" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="fonts/flaticon.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link href="css/owl.theme.default.min.css" rel="stylesheet">
    <link href="css/owl.carousel.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">

</head>
<body>

    <div id="main" class="main-content-wraper">
        <div class="main-content-inner">
            <header class="header ">
                <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-secondary">
                    <div class="container">
                        <ul class="nav navbar-nav mr-auto navbar-left">
                            <li><a href="index.php">خانه</a></li>
                            <?php if(!isset($_SESSION['user'])){ ?>
                                <li><a href="register.php">ثبت نام</a></li>
                                <li><a href="login.php">ورود</a></li>
                            <?php } if(isset($_SESSION['user']) AND @$_SESSION['permission']==1){ ?>
                                <li class="active"><a href="admin/">مدیریت</a></li>
                                <li class="active"><a href="logout.php">خروج</a></li>
                            <?php } if(isset($_SESSION['user']) AND @$_SESSION['permission']==0){?>
                                <li class="active"><a href="profile.php">صفحه شخصی</a></li>
                                <li class="active"><a href="upload.php">آپلود فایل</a></li>
                                <li class="active"><a href="logout.php">خروج</a></li>
                            <?php } ?>
                        </ul>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar"
                            aria-controls="myNavbar" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="myNavbar">
                            <ul class="nav navbar-nav mr-auto navbar-right">
                                <li><a class="page-scroll" href="#videos">ویدئوها</a></li>
                                <li><a class="page-scroll" href="#photos">تصاویر</a></li>
                                <li><a class="page-scroll" href="#files">فایل ها</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>

            <section id="videos" class="biz-product-section ptb-100">
                <div class="biz-product-wrap">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="text-center section-heading">
                                    <h4>ویدئوها</h4>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="owl-carousel owl-theme biz-products carousel-indicator">
                                    <?php while($rows=$videos->fetch()){ ?>
                                        <div class="biz-single-product item">
                                            <div class="biz-product-img text-center">
                                                <video class="border border-dark" width="210" src="uploads/<?=$rows['type']?>/<?=$rows['file']?>"></video>
                                            </div>
                                            <div class="biz-product-content">
                                                <p><?=$rows['title']?></p>
                                                <div class="product-action-btn text-center mt-20">
                                                    <a href="content.php?id=<?=$rows['id']?>">مشاهده جزئیات</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="photos" class="biz-product-section ptb-50">
                <div class="biz-product-wrap">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="text-center section-heading">
                                    <h4>تصاویر</h4>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="owl-carousel owl-theme biz-products carousel-indicator">
                                    <?php while($rows=$photos->fetch()){ ?>
                                        <div class="biz-single-product item">
                                            <div class="biz-product-img img-thumbnail">
                                                <img src='uploads/<?=$rows['type']?>/<?=$rows['file']?>' alt='<?=$rows['file']?>' class='img-responsive'>
                                            </div>
                                            <div class="biz-product-content">
                                                <p><?=$rows['title']?></p>
                                                <div class="product-action-btn text-center mt-20">
                                                    <a href="content.php?id=<?=$rows['id']?>">مشاهده جزئیات</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }  ?>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            <section id="files" class="biz-product-section ptb-50">
                <div class="biz-product-wrap">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="text-center section-heading">
                                    <h4>فایل ها</h4>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="owl-carousel owl-theme biz-products carousel-indicator">
                                    <?php while($rows=$files->fetch()){ ?>
                                        <div class="biz-single-product item">
                                            <div class="biz-product-img img-thumbnail">
                                                <img src="img/dd.png">
                                            </div>
                                            <div class="biz-product-content">
                                                <p><?=$rows['title']?></p>
                                                <div class="product-action-btn text-center mt-20">
                                                    <a href="uploads/files/<?=$rows['file']?>">دانلود</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
            <footer class="footer-section bg-secondary ptb-40">
                <div class="footer-wrap">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="footer-single-col text-center">
                                    <div class="footer-social-list">
                                        <ul class="list-inline">
                                            <li><a href="#"> <i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"> <i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"> <i class="fa fa-linkedin"></i></a></li>
                                            <li><a href="#"> <i class="fa fa-google-plus"></i></a></li>
                                            <li><a href="#"> <i class="fa fa-youtube"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="copyright-text">
                                        <p>&copy; تمامی حقوق نزد این وب سایت محفوظ می باشد</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easeScroll.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/magnific-popup.min.js"></script>
    <script src="js/scripts.js"></script>

</body>
</html>