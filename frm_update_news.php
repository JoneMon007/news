<?php
require_once("db_connect.php");

$news_id = $_GET['isbn'];

$sql = "SELECT * FROM tbnews WHERE news_id = '" . $_GET['isbn'] . "';";
$rs = $db_conn->query($sql)
    or die("Error: " . $sql . "<br/><br/>");
$row = $rs->fetch_assoc();

?>
<html>

<head>
    <meta charset="UTF-8">
    <title>แก้ไขข่าว</title>
    <script src="ckeditor/ckeditor.js"></script>

<body>
    <h1>แก้ไขข่าวรายละเอียดข่าว รหัสข่าว <?php echo $news_id; ?></h1>
    <form id="from1" action="update_news.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="newstype">เลือกประเภทข่าว</label></td>

                <td><select name="newstype">

                        <?php
                        $sql_newstype = "SELECT * FROM tbnewstype";
                        $res_newstype = mysqli_query($db_conn, $sql_newstype);
                        while ($row_newstype = mysqli_fetch_assoc($res_newstype)) {
                            if ($row_newstype['newstype_id'] == $row['newstype_id']) {
                                echo '<option value="' . $row_newstype['newstype_id'] . '" selected>' . $row_newstype['newstype_detail'] . '</option>';
                            } else {
                                echo '<option value="' . $row_newstype['newstype_id'] . '">' . $row_newstype['newstype_detail'] . '</option>';
                            }
                        }
                        ?>

                    </select></td>
            </tr>
            <tr>
                <td><label for="news_topic">หัวข้อข่าว</label></td>
                <td><input type="text" name="news_topic" value="<?php echo $row["news_topic"]; ?>" require size="60"></td>
            </tr>

            <tr>
                <td><label for="news_detail">เนื้อหาข่าว</label></td>
                <td><textarea name="news_detail" id="news_detail" rows="10" cols="80">
                        <?php echo $row["news_detail"]; ?>      
                        </textarea></td>
            </tr>

            <script>
                CKEDITOR.replace('news_detail');
            </script>

            <table>
                <br>
                <td>ไฟล์แนบ : </td>
                <tr>
                    <td><a href='./fileupload/<?php echo $row["news_filename"]; ?>' target='_blank'> <?php echo $row["news_filename"]; ?> </a>


                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>ไฟล์แนบใหม่ : </td>
                <tr>
                    <td align='center'><label>
                            <input type="file" name="fileupload" id="fileupload" />
                        </label>
                </tr>
                </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>


            <tr>
                <td><label for="news_status">สถานะข่าว</label></td>
                <?php
                if ($row["news_status"] == 0) {
                    echo   "<td><input type='radio' value='0' checked name='news_status'>ข่าวทั่วไป ";
                    echo   "<input type='radio' value='1' name='news_status'>ข่าวเด่น </td></tr>";
                } else {
                    echo   "<td><input type='radio' value='0'  name='news_status'>ข่าวทั่วไป ";
                    echo   "<input type='radio' value='1'  checked name='news_status'>ข่าวเด่น </td></tr>";
                }
                ?>


                <input type="hidden" name="f_news_id" value="<?php echo $row['news_id']; ?>">

                <input type="submit" name="button" id="button" value="Upload" />
        </table>
    </form>
</body>
</head>

</html>