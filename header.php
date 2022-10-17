<?php
session_save_path("./session");
session_start();
?>
&nbsp;
<img src='./image/logo.png' width=100 height=100>
<nav class="uk-navbar uk-margin-large-bottom">

    <a class="uk-navbar-brand uk-hidden-small" href="index.php">newsMon007</a>

    <ul class="uk-navbar-nav uk-hidden-small">
        <li class="uk-active">
            <a href="index.php">หน้าแรก</a>
        </li>
        <li>
            <a href="all_news.php">ข่าวทั้งหมด</a>
        </li>
        <li>
            <a href="indexlogin.php">เข้าสู่ระบบ</a>
        </li>

        <?php
        if (isset($_SESSION['firstname'])) {

            echo    "<li>";
            echo    "<a href='main.php'>เมนูแก้ไข</a>";
            echo    "</li>";

            echo    "<li>";
            echo    "<a href='logout.php'>ออกจากระบบ</a>";
            echo    "</li>";

            echo    "<li>";
            echo    "<a>&nbsp;</a>";
            echo    "</li>";
            echo    "<li>";
            echo    "<a>&nbsp;</a>";
            echo    "</li>";
            echo    "<li>";
            echo    "<a>&nbsp;</a>";
            echo    "</li>";
            echo    "<li>";
            echo    "<a>&nbsp;</a>";
            echo    "</li>";
            echo    "<li>";
            echo    "<a>&nbsp;</a>";
            echo    "</li>";
            echo    "<li>";
            echo    "<a>&nbsp;</a>";
            echo    "</li>";
            echo    "<li>";
            echo    "<a>&nbsp;</a>";
            echo    "</li>";
            echo    "<li>";
            echo    "<a>&nbsp;</a>";
            echo    "</li>";
            echo    "<li>";
            echo    "<a>&nbsp;</a>";
            echo    "</li>";
            echo    "<li>";
            echo    "<a>&nbsp;</a>";
            echo    "</li>";
            echo    "<li>";
            echo    "<a>&nbsp;</a>";
            echo    "</li>";
            echo    "<li>";
            echo    "<a>&nbsp;</a>";
            echo    "</li>";
            echo    "<li>";
            echo    "<a>&nbsp;</a>";
            echo    "</li>";
            echo    "<li>";
            echo    "<a>&nbsp;</a>";
            echo    "</li>";


            echo    "<li>";
            echo    "<img src='./image/Sample_User_Icon.png' width=30 height=40>\n";
            echo    $_SESSION["firstname"] . " " . $_SESSION["lastname"] . "\n";
            echo    "</li>";
        }
        ?>

    </ul>

    <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas=""></a>
    <!-- <div class="uk-navbar-brand uk-navbar-center uk-visible-small">newsMon007</div> -->
</nav>