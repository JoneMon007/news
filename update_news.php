<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database: 
include('db_connect.php');

if (is_uploaded_file($_FILES['fileupload']['tmp_name'])) {
    //delete old image
    $sql_select = "SELECT news_filename FROM tbnews WHERE news_id = '" . $_POST["f_news_id"] . "';";
    mysqli_query($db_conn, $sql_select);
    $row_image = mysqli_fetch_assoc($result_image);
    $image_old = $row_image['news_filename'];
    unlink("fileupload/" . $image_old);




    $fileupload = $_POST['fileupload']; //รับค่าไฟล์จากฟอร์ม
    //ฟังก์ชั่นสุ่มตัวเลข
    $numrand = (mt_rand());
    //เพิ่มไฟล์
    $upload = $_FILES['fileupload'];
    if ($upload != '') {   //not select file
        //โฟลเดอร์ที่จะ upload file เข้าไป 
        $path = "fileupload/";

        //เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
        $type = strrchr($_FILES['fileupload']['name'], ".");

        //ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
        $newname = $numrand . $type;
        $path_copy = $path . $newname;
        $path_link = "fileupload/" . $newname;
        //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
        move_uploaded_file($_FILES['fileupload']['tmp_name'], $path_copy);
        $sql_image  = "UPDATE tbnews ";
        $sql_image .= "SET news_filename = '$newname'";
        $sql_image .= "WHERE news_id = '" . $_POST["f_news_id"] . "';"; // PK

        if ($db_conn->query($sql_image) == FALSE) {
            echo "<font color='#FF0000'>Error: " . $sql_image . "<br/><br/>\n";
            echo $db_conn->error . "</font>\n";
            $db_conn->close();
            exit(0);
        } else {
            echo "<font color='blue'>Insert successfully.</font>\n";
        }
    }
}

// //ฟังก์ชั่นวันที่
date_default_timezone_set('Asia/Bangkok');
$date = date("Y-m-d H:i:s");


$sql  = "UPDATE tbnews ";
$sql .= "SET news_topic = '" . $_POST["news_topic"] . "', ";
$sql .=        "news_topic = '" . $_POST["news_topic"] . "', ";
$sql .=        "news_detail = '" . $_POST["news_detail"] . "', ";
$sql .=        "news_status = '" . $_POST["news_status"] . "', ";
$sql .=        "newstype_id = '" . $_POST["newstype"] . "', ";
$sql .=        "news_date = '$date' ";
$sql .= "WHERE news_id = '" . $_POST["f_news_id"] . "';"; // PK

echo $sql . "<br/><br/>";

if ($db_conn->query($sql) == FALSE) {
    echo "<font color='#FF0000'>Error: " . $sql . "<br/><br/>\n";
    echo $db_conn->error . "</font>\n";
    $db_conn->close();
    exit(0);
} else {
    echo "<font color='blue'>Insert successfully.</font>\n";
}


// if($result){
// echo "<script type='text/javascript'>";
// echo "alert('Upload File Succesfuly');";
// echo "window.location = 'main.php'; ";
// echo "</script>";
// }
// else{
// echo "<script type='text/javascript'>";
// echo "alert('Error back to upload again');";
// echo "window.location = 'form.php'; ";
// echo "</script>";
//}
echo "<meta http-equiv='Refresh' content='0;url=main.php'>\n";
?>