<?php
session_save_path("./session");
session_start();
//include_once("check_session_timeout.php");

require_once("db_connect.php");

$sql = "SELECT username ,firstname ,lastname FROM user_account ";
$sql.= "WHERE username = '" .$_POST["f_username"]. "' AND ".
        "password = '" .$_POST["f_password"]."';";

$rs = $db_conn->query($sql)
    or die ("Query failed: " . $sql . "<br><br>");

    if($rs->num_rows == 1){
        $row = $rs->fetch_assoc();
            $_SESSION["firstname"] = $row["firstname"];
            $_SESSION["lastname"] = $row["lastname"];
            echo"<meta http-equiv='Refresh' content='0;url=main.php'>\n";
    } else {
        echo "<font color='red'>Invalid username or password.</font>";
        echo"<meta http-equiv='Refresh' content='3;url=indexlogin.php'>\n";
    }
?>