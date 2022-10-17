<!DOCTYPE html>
<html>

<head>
    <?php
    require_once("db_connect.php");
    $newstype_id = $_GET['newstype_id'];
    ?>
    <title>NewsMon007</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/uikit.min.css" />
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</head>

<body>
    <div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">

        <?php

        include 'header.php';

        ?>

        <div class="uk-grid" data-uk-grid-margin="">
            <div class="uk-width-medium-3-4 uk-row-first">

                <?php
                include 'right.php';

                echo "<article class='uk-article'>";

                echo "<h1 class='uk-article-title'>";

                $sql = "SELECT * FROM tbnews INNER JOIN tbnewstype ON tbnews.newstype_id = tbnewstype.newstype_id 
                                    WHERE tbnews.newstype_id ='$newstype_id'  ORDER By news_id DESC";
                $rs = $db_conn->query($sql)
                    or die("Error: " . $sql . "<br/><br/>");
                if ($rs->num_rows > 0) {
                    while ($row = $rs->fetch_assoc()) {
                        if ($row["news_status"] == "1") {
                            echo "<a href='f_news.php?newstype_id=" . $row['news_id'] . "'>" . $row['news_topic'] . "</a>";


                            echo "</h1>";

                            echo "<p class='uk-article-meta'><a href='#'>" . $row['news_date'] . "</a></p>";

                            echo "<p>";
                            echo     "<a href='f_news.php?newstype_id=" . $row['news_id'] . "'><img width='900' height='300' src='fileupload/" . $row['news_filename'] . "' alt=''></a>";
                            echo "</p>";

                            echo "<p>" . $row['news_detail'] . "</p>";
                            echo "<p>------------------------------------------------------------------------------------------------------------------------------------</p>";
                        }

                        if ($row["news_status"] == "0") {
                            echo "<a href='f_news.php?newstype_id=" . $row['news_id'] . "'>" . $row['news_topic'] . "</a>";


                            echo "</h1>";

                            echo "<p class='uk-article-meta'><a href='#'>" . $row['news_date'] . "</a></p>";

                            echo "<p>";
                            echo     "<a href='f_news.php?newstype_id=" . $row['news_id'] . "'><img width='900' height='300' src='fileupload/" . $row['news_filename'] . "' alt=''></a>";
                            echo "</p>";

                            echo "<p>" . $row['news_detail'] . "</p>";
                            echo "<p>------------------------------------------------------------------------------------------------------------------------------------</p>";
                        }
                    }
                }

                echo "<a class='uk-button uk-button-primary' href='layouts_post.html'>Continue Reading</a>";
                echo "<a class='uk-button' href='layouts_post.html'>4 Comments</a>";
                echo "</p>";

                echo "</article>";
                ?>
            </div>



        </div>
</body>

</html>