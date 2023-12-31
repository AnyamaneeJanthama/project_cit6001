<?php

use Mpdf\Tag\Select;

include("connect.php");

$case = $_GET['xCase'];
$id = $_GET['id'];
switch ($case) {
    case 1: //insert customer
        $datesave = $_POST['datesave'];
        $receiptcode = $_POST['receiptcode'];
        $datereceipt = $_POST['datereceipt'];
        $project_id = $_POST['project_id'];
        $totalprice = $_POST['totalprice'];

        $dateTime = new DateTime();
        $currentDateTime = $dateTime->format('Y-m-d H:i:s');
        $timestamp = $dateTime->getTimestamp();
        $day = date("d", $timestamp);
        $month = date("m", $timestamp);
        $year = substr(date("Y", $timestamp), -2);

        $no = 1;

        $sql = "SELECT MAX(headcode) AS id FROM project_hd";
        $objQuery = mysqli_query($conn, $sql);
        while ($objResult = mysqli_fetch_array($objQuery)) {
            if ($objResult["id"] !== null) {
                $no = (string)((int)$objResult["id"] + 1); // แปลงค่าให้เป็นชนิดข้อมูล BIGINT (string)
            }
        }

        $docno = "0000" . $no; // เอาเลข 0 เติมให้ครบ 4 หลัก
        $docno = substr($docno, -4); // เอาเฉพาะ 4 ตัวหลัง
        $docno = $year . $month . $docno; // เลขที่เอกสารใหม่ คือ YYMMตามด้วยเลขที่

        //multi insert detail
        if (!empty($_POST['s_id'])) {
            $no = $year . $month . str_pad($id, 4, '0', STR_PAD_LEFT);
            $s_ids = $_POST['s_id'];
            $qtys = $_POST['qty'];
            $s_prices = $_POST['s_price'];
            $totalprices = $_POST['totalprice'];
            for ($i = 0; $i < count($s_ids); $i++) {
                $s_id = $s_ids[$i];
                $qty = $qtys[$i];
                $s_price = $s_prices[$i];
                $totalprice = $totalprices[$i];
                $sql = "INSERT INTO project_desc (headcode, s_id, qty, s_price, totalprice) VALUES ('$docno', '$s_id', '$qty', '$s_price', '$totalprice')";
                if ($conn->query($sql) !== TRUE) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }

        $spl = mysqli_query($conn, "INSERT INTO project_hd (headcode, datesave, receiptcode, datereceipt, project_id, totalprice, status, void) VALUES ('$docno','$datesave','$receiptcode','$datereceipt','$project_id','$totalprice', 1 ,0)");
        if (!$spl) {
            echo json_encode(array('title' => 'ดำเนินการไม่สำเร็จ!', 'status' => 'error', 'message' => 'ข้อมูลยังไม่ถูกบันทึก โปรดตรวจสอบความถูกต้อง'));
        } else {
            echo json_encode(array('title' => 'ดำเนินการสำเร็จ!', 'status' => 'success', 'message' => 'การดำเนินการบันทึกข้อมูลเสร็จสมบูรณ์'));
        }
        break;

    case 2: //Update
        $datesave = $_POST['datesave'];
        $receiptcode = $_POST['receiptcode'];
        $datereceipt = $_POST['datereceipt'];
        $project_id = $_POST['project_id'];
        $totalprice = $_POST['totalprice'];

        $spl = mysqli_query($conn, "UPDATE project_hd SET datesave = '$datesave', receiptcode = '$receiptcode',datereceipt = '$datereceipt'
        ,project_id = '$project_id',totalprice = '$totalprice' WHERE project_id = $id");
        if (!$spl) {
            echo json_encode(array('title' => 'ดำเนินการไม่สำเร็จ!', 'status' => 'error', 'message' => 'ข้อมูลยังไม่ถูกไม่เปลี่ยนแปลง โปรดตรวจสอบความถูกต้อง'));
        } else {
            echo json_encode(array('title' => 'ดำเนินการสำเร็จ!', 'status' => 'success', 'message' => 'การดำเนินการเปลี่ยนแปลงข้อมูลเสร็จสมบูรณ์'));
        }
        break;
    case 3:
        $id = $_GET['id'];
        $spl = mysqli_query($conn, "UPDATE project_hd SET void = '1' WHERE headcode = $id");
        if (!$spl) {
            echo json_encode(array('title' => 'ดำเนินการไม่สำเร็จ!', 'status' => 'error', 'message' => 'ข้อมูลยังไม่ถูกลบ โปรดตรวจสอบความถูกต้อง'));
        } else {
            echo json_encode(array('title' => 'ดำเนินการสำเร็จ!', 'status' => 'success', 'message' => 'การดำเนินการลบข้อมูลเสร็จสมบูรณ์'));
        }
        break;
    case 4:
        $project_id = mysqli_real_escape_string($conn, $_GET['id']); // Correct the variable name to 'project_id'

        // SQL query to fetch project details
        $sql = "SELECT * FROM project JOIN customer USING(cus_id) WHERE project_id = '$project_id' AND project.void = 0";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $project_name = $row['project_name'];
            $cus_firstname = $row['cus_firstname'];
            $cus_lastname = $row['cus_lastname'];
            $project_valueprice = $row['project_valueprice'];
            $project_fullname = $cus_firstname . ' ' . $cus_lastname;

            // Create an array to hold project data and echo it as JSON
            $projectData = [
                'project_id' => $project_id,
                'project_name' => $project_name,

                'project_fullname' => $project_fullname,

                'project_valueprice' => $project_valueprice
            ];

            echo json_encode($projectData);
        } else {
            echo "ไม่สามารถดึงข้อมูลโครงการได้: " . mysqli_error($conn);
        }
        break;
    case 5:
        $s_id = mysqli_real_escape_string($conn, $_GET['id']);

        // SQL query to fetch project details
        $sql = "SELECT * FROM `stock` WHERE s_id = '$s_id' AND void = 0 ";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $s_name = $row['s_name'];
            $s_unit = $row['s_unit'];
            $s_price = $row['s_price'];

            // Create an array to hold project data and echo it as JSON
            $stockData = [
                's_id' => $s_id,
                's_name' => $s_name,
                's_unit' => $s_unit,
                's_price' => $s_price
            ];

            echo json_encode($stockData);
        } else {
            echo "ไม่สามารถดึงข้อมูลสินค้าได้: " . mysqli_error($conn);
        }
}
