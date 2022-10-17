<?php
session_save_path("./session");
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    require_once("db_connect.php");

    echo "<script language='JavaScript'>\n";
    echo "function checkAll(source) { \n";
    echo "	checkboxes = document.getElementsByName('f_chk[]'); \n";
    echo "	for (var i=0, n=checkboxes.length; i<n; i++) { \n";
    echo "		checkboxes[i].checked = source.checked; \n";
    echo "	} \n";
    echo "} \n";
    echo "</script>\n";

    ?>
    <title>NewsMon007</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/uikit.min.css" />
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
    </script>
</head>

<body>
    <a a href='index.php'>หน้าเว็ปข่าว</a>
    <h1>ยินดีต้อนรับ</h1>
    <p>คุณ <?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"] . "\n"; ?></p>
    <a href='logout.php'>ออกจากระบบ</a>
    <h1>เมนูหลัก</h1>


    <form method="post" role="search">
        <div>
            <strong>ค้นหาข้อมูล</strong>
            <input type="text" name="search">
            <span>
                <button type="submit"> ค้นหา</button>
            </span>
        </div>
        <div>
            <br>
        </div>
    </form>


    <form method='post' action='delete_news.php'>


        <table>
            <tr>
            <tr>
                <th><input type='checkbox' onClick='checkAll(this)'></th>
                <td>รหัสข่าว</td>
                <td>หัวข้อข่าว</td>
                <td>ไฟล์แนบ</td>
                <td>สถานะ</td>
                <td>เวลา</td>
                <td>ประเภทข่าว</td>
                <td>แก้ไข</td>
                <td>ลบ</td>
            </tr>
            <tr>

                <?php

                $ss = $_POST['search'];

                if (strlen($ss) > 0) {
                    $sql = "SELECT * FROM tbnews WHERE news_topic LIKE '%" . $ss . "%'; ";
                } else {
                    $sql = "SELECT * FROM tbnews INNER JOIN tbnewstype ON tbnews.newstype_id = tbnewstype.newstype_id ORDER By news_id DESC";
                }

                $rs = $db_conn->query($sql)
                    or die("Error: " . $sql . "<br/><br/>");

                if ($rs->num_rows > 0) {
                    while ($row = $rs->fetch_assoc()) {
                        echo "<tr>\n";
                        echo "<td><input type='checkbox' name='f_chk[]' value='" . $row["news_id"] . "'/></td>\n";
                        echo "<td>" . $row["news_id"] . "</td>\n";
                        echo "<td>" . $row["news_topic"] . "</td>\n";
                        echo "<td><a href='./fileupload/" . $row["news_filename"] . "'target='_blank'>" . $row["news_filename"] . "</a></td>\n";

                        echo "<td>";
                        if ($row["news_status"] == "1") {
                            echo "<font>ข่าวเด่น</font>";
                        } else {
                            echo "<font>ข่าวตกกะปิ</font>";
                        }
                        echo "<td>" . $row["news_date"] . "</td>\n";
                        echo "<td>" . $row["newstype_detail"] . "</td>\n";
                        echo "</td>\n";

                        echo "<td align='center'>";
                        echo "<a href='frm_update_news.php?isbn=" . $row["news_id"] . "'>";
                        echo "<img src='./image/removebg-preview.png' width=30 height=40 title='Delete'/></a></td>\n";

                        echo "<td align='center'>";
                        echo "<a href='delete_news.php?isbn=" . $row["news_id"] . "'>";
                        echo "<img src='./image/delete.png' width=30 height=40 title='Delete'/></a></td>\n";

                        echo "</tr>\n";
                    }
                    echo "<style type='text/css'>\n";
                    echo "tbody tr:nth-child(even) { \n";
                    echo "	background-color: #F7F7F7;\n";
                    echo "}\n";
                    echo "</style>\n";

                    echo "<tr><td colspan='6'><input type='submit' value='Delete'/></td></tr>";
                    $rs->free_result();
                } else {
                    echo "<tr><td colspan='6'>Data not found.</td></tr>";
                }
                $db_conn->close();
                ?>
            </tr>
    </form>
    </table>

    <li><a href='frm_news.php'>เพิ่มข่าว</a>
    <li><a href='f_book_main.php'>แก้ไขข่าว</a>
    <li><a href='f_book_main.php'>ลบข่าว</a>
        <?php
        require_once("counter.php");
        ?>
</body>

</html>