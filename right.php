<?php
// require_once("db_connect.php");
// $sql2 = "SELECT * FROM tbnewstype ";
// $row_newstype = mysqli_query($db_conn, $sql2);
$sql2 = "SELECT * FROM tbnewstype ";
$rs2 = $db_conn->query($sql2) 
or die("Error: " .$sql2. "<br/><br/>");
?>

<div class="uk-width-medium-1-4">
    <div class="uk-panel">
        <ul class="uk-navbar-nav uk-hidden-small">
            <?php
                while ($row2 = $rs2->fetch_assoc()) {
                
                    echo "<li><a href='news.php?newstype_id=".$row2['newstype_id']."'>".$row2['newstype_detail']."</a></li>";
                     } ?>
        </ul>
    </div>
</div>