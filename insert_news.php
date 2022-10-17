<meta charset="UTF-8">
<?php
//1. เชื่อมต่อ database: 
include('db_connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
$fileupload = $_POST['fileupload']; //รับค่าไฟล์จากฟอร์ม

//ฟังก์ชั่นวันที่
date_default_timezone_set('Asia/Bangkok');
$date = date("Y-m-d H:i:s");
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
}
// เพิ่มไฟล์เข้าไปในตาราง uploadfile
$news_topic = $_POST['news_topic'];
$news_detail = $_POST['news_detail'];
$news_status = $_POST['news_status'];
$newstype = $_POST['newstype'];

$sql = "INSERT INTO tbnews (news_filename , news_topic ,news_status ,news_detail, news_date,newstype_id) 
            VALUES('$newname','$news_topic','$news_status','$news_detail','$date','$newstype')";

$result = mysqli_query($db_conn, $sql);

mysqli_close($db_conn);
// javascript แสดงการ upload file

if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('Upload File Succesfuly');";
    echo "window.location = 'main.php'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('Error back to upload again');";
    echo "window.location = 'form.php'; ";
    echo "</script>";
}
?>