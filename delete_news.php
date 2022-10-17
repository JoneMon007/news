<?php
require_once("db_connect.php");

if (isset($_GET['isbn'])) {	// from hyperlink
$sql = "DELETE FROM tbnews WHERE news_id = '".$_GET['isbn']."';";
	// $sql = "UPDATE books SET status = 'D' WHERE isbn = '".$_GET["isbn"]."';";
	echo $sql;

	if ($db_conn->query($sql) == FALSE) {
		echo "<font color='red>Error: " .$sql. "<br/><br/>";
		echo $db_conn->error . "</font>\n";
		$db_conn->close();
		exit(0);
	} 
} else if (isset($_POST["f_chk"])) {	// from delete button
	$isbn = $_POST["f_chk"];
	for ($i=0; $i<count($isbn); $i++) {
    $sql = "DELETE FROM tbnews WHERE news_id = '".$isbn[$i]."';";
		// $sql = "UPDATE books SET status = 'D' WHERE isbn = '".$isbn[$i]."';";
		echo $sql . "<br/>\n";
		if ($db_conn->query($sql) == FALSE) {
			echo "<font color='red>Error: " .$sql. "<br/><br/>";
			echo $db_conn->error . "</font>\n";
			$db_conn->close();
			exit(0);
		} 
	}
}

// URL redirect
//echo"<meta http-equiv='Refresh' content='0;url=f_book_delete.php'>\n";
echo"<meta http-equiv='Refresh' content='0;url=main.php'>\n";

?>