<?php
require_once "../includes/dbconfig.php";
?>
<img src="img/user.png" class="img-fluid" alt="" width="50" height="50">
<h5 class="font-weight-bold pt-3"><?=$_SESSION['fullname']?></h5>
<hr>
<!-- Menu -->
<nav class="text-right">
    <div class="d-flex justify-content-between py-2">
        <a class="d-block" href="index.php">داشبورد</a>
        <i class="fas fa-home"></i>
    </div>
    <div class="d-flex justify-content-between py-2">
        <a class="d-block" href="users.php">کاربران</a>
        <i class="fas fa-user"></i>
    </div>
    <div class="d-flex justify-content-between py-2">
        <a class="d-block" href="pension_list.php">حقوق ها</a>
        <i class="fas fa-dollar-sign"></i>
    </div>
    <ul class="nav nav-sidebar d-flex justify-content-between p-0" data-widget="treeview">
        <li class="nav-item"><a href="" class="nav-link px-0">فایل ها<i class="fas fa-caret-down mr-1 text-muted"></i></a>
            <ul class="nav nav-treeview px-2">
                <li class="nav-item"><a href="add.php" class="nav-link py-1">افزودن</a></li>
                <li class="nav-item"><a href="list.php" class="nav-link py-1">لیست فایل ها</a></li>
            </ul>
        </li>
        <i class="fas fa-file"></i>
    </ul>
    <div class="d-flex justify-content-between py-2">
        <a class="d-block" href="logout.php">خروج</a>
        <i class="fas fa-sign-out-alt "></i>
    </div>
</nav>