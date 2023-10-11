<?php

use Mpdf\Tag\Select;

include("connect.php");

$case = $_GET['xCase'];
$id = $_GET['id'];
switch ($case) {
    case 1: //insert customer
        $cus_firstname = $_POST['cus_firstname'];
        $cus_lastname = $_POST['cus_lastname'];
        $cus_address = $_POST['cus_address'];
        $cus_subdis = $_POST['cus_subdis'];
        $cus_district = $_POST['cus_district'];
        $cus_province = $_POST['cus_province'];
        $cus_postcode = $_POST['cus_postcode'];
        $cus_phone = $_POST['cus_phone'];
        $cus_email = $_POST['cus_email'];

        $maxID = mysqli_query($conn, "SELECT MAX(cus_id) AS id FROM customer ORDER BY cus_id");
        if (mysqli_num_rows($maxID) > 0) {
            while ($row = mysqli_fetch_assoc($maxID)) {
                $id = $row['id'] + 1;
            }
        }

        $zeroid = "0000" . $id; // เอาเลข 0 เติมให้ครบ 4 หลัก
        $zeroid = substr($zeroid, -4); // เอาเฉพาะ 4 ตัวหลัง

        $spl = mysqli_query($conn, "INSERT INTO customer VALUES ('$zeroid','$cus_firstname','$cus_lastname','$cus_address','$cus_subdis','$cus_district', '$cus_province','$cus_postcode','$cus_phone','$cus_email',0)");
        if (!$spl) {
            echo json_encode(array('title' => 'ดำเนินการไม่สำเร็จ!', 'status' => 'error', 'message' => 'ข้อมูลยังไม่ถูกบันทึก โปรดตรวจสอบความถูกต้อง'));
        } else {
            echo json_encode(array('title' => 'ดำเนินการสำเร็จ!', 'status' => 'success', 'message' => 'การดำเนินการบันทึกข้อมูลเสร็จสมบูรณ์'));
        }
        break;

    case 2: //Update
        $cus_firstname = $_POST['cus_firstname'];
        $cus_lastname = $_POST['cus_lastname'];
        $cus_address = $_POST['cus_address'];
        $cus_subdis = $_POST['cus_subdis'];
        $cus_district = $_POST['cus_district'];
        $cus_province = $_POST['cus_province'];
        $cus_postcode = $_POST['cus_postcode'];
        $cus_phone = $_POST['cus_phone'];
        $cus_email = $_POST['cus_email'];

        $spl = mysqli_query($conn, "UPDATE customer SET cus_firstname = '$cus_firstname', cus_lastname = '$cus_lastname',cus_address = '$cus_address'
        ,cus_subdis = '$cus_subdis',cus_district = '$cus_district', cus_province = '$cus_province', cus_postcode = '$cus_postcode', 
        cus_phone = '$cus_phone', cus_email = '$cus_email' WHERE cus_id = $id");
        if (!$spl) {
            echo json_encode(array('title' => 'ดำเนินการไม่สำเร็จ!', 'status' => 'error', 'message' => 'ข้อมูลยังไม่ถูกไม่เปลี่ยนแปลง โปรดตรวจสอบความถูกต้อง'));
        } else {
            echo json_encode(array('title' => 'ดำเนินการสำเร็จ!', 'status' => 'success', 'message' => 'การดำเนินการเปลี่ยนแปลงข้อมูลเสร็จสมบูรณ์'));
        }
        break;

    case 3:
        $id = $_GET['id'];
        $spl = mysqli_query($conn, "UPDATE customer SET void = '1' WHERE cus_id = $id");
        if (!$spl) {
            echo json_encode(array('title' => 'ดำเนินการไม่สำเร็จ!', 'status' => 'error', 'message' => 'ข้อมูลยังไม่ถูกลบ โปรดตรวจสอบความถูกต้อง'));
        } else {
            echo json_encode(array('title' => 'ดำเนินการสำเร็จ!', 'status' => 'success', 'message' => 'การดำเนินการลบข้อมูลเสร็จสมบูรณ์'));
        }

        break;
}
