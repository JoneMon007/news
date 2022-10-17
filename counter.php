<!DOCTYPE html>
<html>

<head>
    <title>ThaiCreate.Com Tutorials</title>
</head>

<body>
    <?php
    //*** By Weerachai Nukitram ThaiCreate.Com ***//

    //*** Connect MySQL ***//
    require_once("db_connect.php");
    //*** Select วันที่ในตาราง Counter ว่าปัจจุบันเก็บของวันที่เท่าไหร่  ***//
    //*** ถ้าเป็นของเมื่อวานให้ทำการ Update Counter ไปยังตาราง daily และลบข้อมูล เพื่อเก็บของวันปัจจุบัน ***//
    $strSQL = " SELECT DATE FROM counter LIMIT 0,1";
    $con = mysqli_connect("localhost", "root", "12345678", "news");
    $objQuery = mysqli_query( $con, $strSQL );
    $objResult = mysqli_fetch_array($objQuery);

    if ($objResult["DATE"] != date("Y-m-d")) {
        //*** บันทึกข้อมูลของเมื่อวานไปยังตาราง daily ***//
        $strSQL = " INSERT INTO daily (DATE,NUM) SELECT '" . date('Y-m-d', strtotime("-1 day")) . "',COUNT(*) AS intYesterday FROM  counter WHERE 1 AND DATE = '" . date('Y-m-d', strtotime("-1 day")) . "'";
        mysqli_query( $con, $strSQL );

        //*** ลบข้อมูลของเมื่อวานในตาราง counter ***//
        $strSQL = " DELETE FROM counter WHERE DATE != '" . date("Y-m-d") . "' ";
        mysqli_query( $con, $strSQL );
    }

    //*** Insert Counter ปัจจุบัน ***//
    $strSQL = " INSERT INTO counter (DATE,IP) VALUES ('" . date("Y-m-d") . "','" . $_SERVER["REMOTE_ADDR"] . "') ";
    mysqli_query( $con, $strSQL );

    //******************** Get Counter ************************//

    // Today //
    $strSQL = " SELECT COUNT(DATE) AS CounterToday FROM counter WHERE DATE = '" . date("Y-m-d") . "' ";
    $objQuery = mysqli_query( $con, $strSQL );
    $objResult = mysqli_fetch_array($objQuery);
    $strToday = $objResult["CounterToday"];

    // Yesterday //
    $strSQL = " SELECT NUM FROM daily WHERE DATE = '" . date('Y-m-d', strtotime("-1 day")) . "' ";
    $objQuery = mysqli_query( $con, $strSQL );
    $objResult = mysqli_fetch_array($objQuery);
    $strYesterday = $objResult["NUM"];

    // This Month //
    $strSQL = " SELECT SUM(NUM) AS CountMonth FROM daily WHERE DATE_FORMAT(DATE,'%Y-%m')  = '" . date('Y-m') . "' ";
    $objQuery = mysqli_query( $con, $strSQL );
    $objResult = mysqli_fetch_array($objQuery);
    $strThisMonth = $objResult["CountMonth"];

    // Last Month //
    $strSQL = " SELECT SUM(NUM) AS CountMonth FROM daily WHERE DATE_FORMAT(DATE,'%Y-%m')  = '" . date('Y-m', strtotime("-1 month")) . "' ";
    $objQuery = mysqli_query( $con, $strSQL );
    $objResult = mysqli_fetch_array($objQuery);
    $strLastMonth = $objResult["CountMonth"];

    // This Year //
    $strSQL = " SELECT SUM(NUM) AS CountYear FROM daily WHERE DATE_FORMAT(DATE,'%Y')  = '" . date('Y') . "' ";
    $objQuery = mysqli_query( $con, $strSQL );
    $objResult = mysqli_fetch_array($objQuery);
    $strThisYear = $objResult["CountYear"];

    // Last Year //
    $strSQL = " SELECT SUM(NUM) AS CountYear FROM daily WHERE DATE_FORMAT(DATE,'%Y')  = '" . date('Y', strtotime("-1 year")) . "' ";
    $objQuery = mysqli_query( $con, $strSQL );
    $objResult = mysqli_fetch_array($objQuery);
    $strLastYear = $objResult["CountYear"];

    //*** Close MySQL ***//
    mysqli_close($con);
    ?>

    <table width="183" border="1">
        <tr>
            <td colspan="2">
                <div align="center">Statistics</div>
            </td>
        </tr>
        <tr>
            <td width="98">Today</td>
            <td width="75">
                <div align="center"><?php echo number_format($strToday, 0); ?></div>
            </td>
        </tr>
        <tr>
            <td>Yesterday</td>
            <td>
                <div align="center"><?php echo number_format($strYesterday, 0); ?></div>
            </td>
        </tr>
        <tr>
            <td>This Month </td>
            <td>
                <div align="center"><?php echo number_format($strThisMonth, 0); ?></div>
            </td>
        </tr>
        <tr>
            <td>Last Month </td>
            <td>
                <div align="center"><?php echo number_format($strLastMonth, 0); ?></div>
            </td>
        </tr>
        <tr>
            <td>This Year </td>
            <td>
                <div align="center"><?php echo number_format($strThisYear, 0); ?></div>
            </td>
        </tr>
        <tr>
            <td>Last Year </td>
            <td>
                <div align="center"><?php echo number_format($strLastYear, 0); ?></div>
            </td>
        </tr>
    </table>
</body>
<html>