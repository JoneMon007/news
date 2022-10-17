<?php
require_once("db_connect.php");
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>เพิ่มข่าว</title>
    <script src="ckeditor/ckeditor.js"></script>

<body>
    <h1>เพิ่มข่าว</h1>
    <form id="from1" action="insert_news.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="newstype">เลือกประเภทข่าว</label></td>

                <td><select name="newstype">
                        <option value="">--กรุณาเลือกประเภทข่าว--</option>
                        <!-- <option value="001">ทั่วไป</option>
                            <option value="002">ข่าวบันเทิง</option>
                            <option value="003">กีฬา</option>
                            <option value="004">รถยนต์</option> -->
                        <?php
                        $sql_newstype = "SELECT * FROM tbnewstype";
                        $res_newstype = mysqli_query($db_conn, $sql_newstype);
                        while ($row_newstype = mysqli_fetch_assoc($res_newstype)) {
                            echo '<option value="' . $row_newstype['newstype_id'] . '">' . $row_newstype['newstype_detail'] . '</option>';
                        }
                        ?>
                    </select></td>
            </tr>
            <tr>
                <td><label for="news_topic">หัวข้อข่าว</label></td>
                <td><input type="text" name="news_topic" require></td>
            </tr>

            <tr>
                <td><label for="news_detail">เนื้อหาข่าว</label></td>
                <td><textarea name="news_detail" id="news_detail" rows="10" cols="80">

                        </textarea></td>
            </tr>

            <script>
                CKEDITOR.replace('news_detail');
            </script>

            <table>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>File Browser</td>
                    <td><label>
                            <input type="file" name="fileupload" id="fileupload" required="required" />
                        </label></td>
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

            <!-- <tr><td><label for="news_filename">ภาพประกอบข่าว</label></td>
                        <td><input type="file" name="news_filename"></td></tr> -->
            <tr>
                <td><label for="news_status">สถานะข่าว</label></td>
                <td><input type="radio" value="0" checked name="news_status">ข่าวทั่วไป
                    <input type="radio" value="1" name="news_status">ข่าวเด่น
                </td>
            </tr>

            <input type="submit" name="button" id="button" value="Upload" />
        </table>
    </form>
</body>
</head>

</html>