<?php

use Mpdf\Tag\Select;

include("connect.php");

$case = $_GET['xCase'];
$id = $_GET['id'];
switch ($case) {
    case 1: //insert customer
        $emp_firstname = $_POST['emp_firstname'];
        $emp_lastname = $_POST['emp_lastname'];
        $emp_address = $_POST['emp_address'];
        $emp_subdis = $_POST['emp_subdis'];
        $emp_district = $_POST['emp_district'];
        $emp_province = $_POST['emp_province'];
        $emp_postcode = $_POST['emp_postcode'];
        $emp_phone = $_POST['emp_phone'];
        $emp_email = $_POST['emp_email'];
        $emp_startworking = $_POST['emp_startworking'];
        $emp_password = $_POST['emp_password'];
        $emp_department = $_POST['emp_department'];

        $maxID = mysqli_query($conn, "SELECT MAX(emp_id) AS id FROM employee ORDER BY emp_id");
        if (mysqli_num_rows($maxID) > 0) {
            while ($row = mysqli_fetch_assoc($maxID)) {
                $id = $row['id'] + 1;
            }
        }

        $zeroid = "0000" . $id; // เอาเลข 0 เติมให้ครบ 4 หลัก
        $zeroid = substr($zeroid, -4); // เอาเฉพาะ 4 ตัวหลัง

        $spl = mysqli_query($conn, "INSERT INTO employee VALUES ('$zeroid','$emp_firstname','$emp_lastname','$emp_address','$emp_subdis',
        '$emp_district', '$emp_province','$emp_postcode','$emp_phone','$emp_email','$emp_startworking','$emp_password','$emp_department',0)");
        if (!$spl) {
            echo json_encode(array('title' => 'ดำเนินการไม่สำเร็จ!', 'status' => 'error', 'message' => 'ข้อมูลยังไม่ถูกบันทึก โปรดตรวจสอบความถูกต้อง'));
        } else {
            echo json_encode(array('title' => 'ดำเนินการสำเร็จ!', 'status' => 'success', 'message' => 'การดำเนินการบันทึกข้อมูลเสร็จสมบูรณ์'));
        }
        break;
    case 2: //Update
        $emp_firstname = $_POST['emp_firstname'];
        $emp_lastname = $_POST['emp_lastname'];
        $emp_address = $_POST['emp_address'];
        $emp_subdis = $_POST['emp_subdis'];
        $emp_district = $_POST['emp_district'];
        $emp_province = $_POST['emp_province'];
        $emp_postcode = $_POST['emp_postcode'];
        $emp_phone = $_POST['emp_phone'];
        $emp_email = $_POST['emp_email'];
        $emp_startworking = $_POST['emp_startworking'];
        $emp_password = $_POST['emp_password'];
        $emp_department = $_POST['emp_department'];

        $spl = mysqli_query($conn, "UPDATE employee SET emp_firstname = '$emp_firstname', emp_lastname = '$emp_lastname',emp_address = '$emp_address'
        ,emp_subdis = '$emp_subdis',emp_district = '$emp_district', emp_province = '$emp_province', emp_postcode = '$emp_postcode', 
        emp_phone = '$emp_phone', emp_email = '$emp_email',emp_startworking = '$emp_startworking' , emp_password = '$emp_password'
        , emp_department = '$emp_department' Where emp_id = $id");
        if (!$spl) {
            echo json_encode(array('title' => 'ดำเนินการไม่สำเร็จ!', 'status' => 'error', 'message' => 'ข้อมูลยังไม่ถูกไม่เปลี่ยนแปลง โปรดตรวจสอบความถูกต้อง'));
        } else {
            echo json_encode(array('title' => 'ดำเนินการสำเร็จ!', 'status' => 'success', 'message' => 'การดำเนินการเปลี่ยนแปลงข้อมูลเสร็จสมบูรณ์'));
        }
        break;
    case 3:
        $id = $_GET['id'];
        $spl = mysqli_query($conn, "UPDATE employee SET void = '1' Where emp_id = $id");
        if (!$spl) {
            echo json_encode(array('title' => 'ดำเนินการไม่สำเร็จ!', 'status' => 'error', 'message' => 'ข้อมูลยังไม่ถูกลบ โปรดตรวจสอบความถูกต้อง'));
        } else {
            echo json_encode(array('title' => 'ดำเนินการสำเร็จ!', 'status' => 'success', 'message' => 'การดำเนินการลบข้อมูลเสร็จสมบูรณ์'));
        }
        break;
}
