<?php

$db_host = "localhost";		// DB Server name
$db_user = "adminnews";			// ไม่ควรใช้ user root ในการเขียนโปรแกรม
$db_password = "12345678";	
$db_name = "news";		// DB name

// Create DB connection
$db_conn = new mysqli($db_host,$db_user,$db_password,$db_name);

// if ($db_conn->connect_error) {
// 	die("DB Connection Failed !! " . $db_conn->connect_error);
// } else {
// 	echo "DB Connection Successful.<br><br>";
// }

// run -->  localhost/bookshop/db_connect.php
?>
