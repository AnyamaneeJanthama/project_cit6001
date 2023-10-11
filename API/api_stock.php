<?php

use Mpdf\Tag\Select;

include("connect.php");

$case = $_GET['xCase'];
$id = $_GET['id'];
switch ($case) {
    case 1: //insert customer
        $s_name = $_POST['s_name'];
        $s_unit = $_POST['s_unit'];
        $s_price = $_POST['s_price'];

        $maxID = mysqli_query($conn, "SELECT MAX(s_id) AS id FROM stock ORDER BY s_id");
        if (mysqli_num_rows($maxID) > 0) {
            while ($row = mysqli_fetch_assoc($maxID)) {
                $id = $row['id'] + 1;
            }
        }

        $zeroid = "0000" . $id; // เอาเลข 0 เติมให้ครบ 4 หลัก
        $zeroid = substr($zeroid, -4); // เอาเฉพาะ 4 ตัวหลัง

        $spl = mysqli_query($conn, "INSERT INTO stock VALUES ('$zeroid','$s_name','$s_unit','$s_price',0)");
        if (!$spl) {
            echo json_encode(array('title' => 'ดำเนินการไม่สำเร็จ!', 'status' => 'error', 'message' => 'ข้อมูลยังไม่ถูกบันทึก โปรดตรวจสอบความถูกต้อง'));
        } else {
            echo json_encode(array('title' => 'ดำเนินการสำเร็จ!', 'status' => 'success', 'message' => 'การดำเนินการบันทึกข้อมูลเสร็จสมบูรณ์'));
        }
        break;

    case 2: //Update
        $s_name = $_POST['s_name'];
        $s_unit = $_POST['s_unit'];
        $s_price = $_POST['s_price'];

        $spl = mysqli_query($conn, "UPDATE stock SET s_name = '$s_name', s_unit = '$s_unit',s_price = '$s_price' WHERE s_id = $id");
        if (!$spl) {
            echo json_encode(array('title' => 'ดำเนินการไม่สำเร็จ!', 'status' => 'error', 'message' => 'ข้อมูลยังไม่ถูกไม่เปลี่ยนแปลง โปรดตรวจสอบความถูกต้อง'));
        } else {
            echo json_encode(array('title' => 'ดำเนินการสำเร็จ!', 'status' => 'success', 'message' => 'การดำเนินการเปลี่ยนแปลงข้อมูลเสร็จสมบูรณ์'));
        }
        break;

    case 3:
        $id = $_GET['id'];
        $spl = mysqli_query($conn, "UPDATE stock SET void = '1' WHERE s_id = $id");
        if (!$spl) {
            echo json_encode(array('title' => 'ดำเนินการไม่สำเร็จ!', 'status' => 'error', 'message' => 'ข้อมูลยังไม่ถูกลบ โปรดตรวจสอบความถูกต้อง'));
        } else {
            echo json_encode(array('title' => 'ดำเนินการสำเร็จ!', 'status' => 'success', 'message' => 'การดำเนินการลบข้อมูลเสร็จสมบูรณ์'));
        }
        break;
}
