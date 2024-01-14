<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title?></title>
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
        <header class="header">
            <nav class="navbar navbar-expand-lg navbar-dark top-nav-collapse">
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
                    <div class="collapse navbar-collapse" id="myNavbar">
                    </div>
                </div>
            </nav>
        </header>
