<?php

use Mpdf\Tag\Select;

include("connect.php");

$case = $_GET['xCase'];
$id = $_GET['id'];
switch ($case) {
    case 1: //insert customer
        $project_name = $_POST['project_name'];
        $cus_id = $_POST['cus_id'];
        $project_start = $_POST['project_start'];
        $project_end = $_POST['project_end'];
        $project_valueprice = $_POST['project_valueprice'];
        $emp_id = $_POST['emp_id'];
        $project_status = $_POST['project_status'];

        $maxID = mysqli_query($conn, "SELECT MAX(project_id) AS id FROM project ORDER BY project_id");
        if (mysqli_num_rows($maxID) > 0) {
            while ($row = mysqli_fetch_assoc($maxID)) {
                $id = $row['id'] + 1;
            }
        }

        $zeroid = "0000" . $id; // เอาเลข 0 เติมให้ครบ 4 หลัก
        $zeroid = substr($zeroid, -4); // เอาเฉพาะ 4 ตัวหลัง

        $spl = mysqli_query($conn, "INSERT INTO project VALUES ('$zeroid','$project_name','$cus_id','$project_start','$project_end',
        '$project_valueprice', '$emp_id','$project_status', 0)");
        if (!$spl) {
            echo json_encode(array('title' => 'ดำเนินการไม่สำเร็จ!', 'status' => 'error', 'message' => 'ข้อมูลยังไม่ถูกบันทึก โปรดตรวจสอบความถูกต้อง'));
        } else {
            echo json_encode(array('title' => 'ดำเนินการสำเร็จ!', 'status' => 'success', 'message' => 'การดำเนินการบันทึกข้อมูลเสร็จสมบูรณ์'));
        }
        break;

    case 2: //Update
        $project_name = $_POST['project_name'];
        $cus_id = $_POST['cus_id'];
        $project_start = $_POST['project_start'];
        $project_end = $_POST['project_end'];
        $project_valueprice = $_POST['project_valueprice'];
        $emp_id = $_POST['emp_id'];
        $project_status = $_POST['project_status'];

        $spl = mysqli_query($conn, "UPDATE project SET project_name = '$project_name', cus_id = '$cus_id',project_start = '$project_start'
        ,project_end = '$project_end',project_valueprice = '$project_valueprice', emp_id = '$emp_id', project_status = '$project_status' Where project_id = $id");
        if (!$spl) {
            echo json_encode(array('title' => 'ดำเนินการไม่สำเร็จ!', 'status' => 'error', 'message' => 'ข้อมูลยังไม่ถูกไม่เปลี่ยนแปลง โปรดตรวจสอบความถูกต้อง'));
        } else {
            echo json_encode(array('title' => 'ดำเนินการสำเร็จ!', 'status' => 'success', 'message' => 'การดำเนินการเปลี่ยนแปลงข้อมูลเสร็จสมบูรณ์'));
        }
        break;
    case 3:
        $id = $_GET['id'];
        $spl = mysqli_query($conn, "UPDATE project SET void = '1' Where project_id = $id");
        if (!$spl) {
            echo json_encode(array('title' => 'ดำเนินการไม่สำเร็จ!', 'status' => 'error', 'message' => 'ข้อมูลยังไม่ถูกลบ โปรดตรวจสอบความถูกต้อง'));
        } else {
            echo json_encode(array('title' => 'ดำเนินการสำเร็จ!', 'status' => 'success', 'message' => 'การดำเนินการลบข้อมูลเสร็จสมบูรณ์'));
        }
        break;
}
