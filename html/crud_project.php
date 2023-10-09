<?php
include("header.php");

$case = $_GET['xCase'];
if ($case == '1') {
    $header = 'เพิ่ม';
    $id = '';
    // $result = mysqli_query($conn, "SELECT *,if(project_status = 1,'อยู่ระหว่างดำเนินการ','ปิดโครงการ')AS status FROM project");
    $result_ = mysqli_query($conn, "SELECT * FROM customer");
    $result_emp = mysqli_query($conn, "SELECT * FROM employee");
} else if ($case  == '2') {
    $header = 'แก้ไข';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT *,if(project_status = 0 ,'ยกเลิก',if(project_status = 1,'อยู่ระหว่างดำเนินการ','ปิดโครงการ'))AS status FROM project JOIN customer USING(cus_id) JOIN employee USING(emp_id) WHERE project_id ='$id' ");
    $result_ = mysqli_query($conn, "SELECT * FROM customer");
    $result_emp = mysqli_query($conn, "SELECT * FROM employee");

    if (!$result) {
        die("Database query error: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_array($result);
    // print_r(md5($row['password']));
} else if ($case  == '3') {
    $header = 'ลบ';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * ,if(project_status = 0 ,'ยกเลิก',if(project_status = 1,'อยู่ระหว่างดำเนินการ','ปิดโครงการ'))AS status FROM project JOIN customer USING(cus_id) JOIN employee USING(emp_id)  WHERE project_id ='$id' ");
    $result_ = mysqli_query($conn, "SELECT * FROM customer");
    $result_emp = mysqli_query($conn, "SELECT * FROM employee");

    if (!$result) {
        die("Database query error: " . mysqli_error($conn));
    }
    $row = mysqli_fetch_array($result);
} else if ($case  == '4') {
    $header = 'ดูรายละเอียด';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT *,if(project_status = 0 ,'ยกเลิก',if(project_status = 1,'อยู่ระหว่างดำเนินการ','ปิดโครงการ'))AS status FROM project JOIN customer USING(cus_id) JOIN employee USING(emp_id) WHERE project_id ='$id' ");
    $result_ = mysqli_query($conn, "SELECT * FROM customer");
    $result_emp = mysqli_query($conn, "SELECT * FROM employee");

    if (!$result) {
        die("Database query error: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_array($result);
}
?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include("sidebar.php"); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include("topbar.php") ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <a class="h3 mb-0 text-gray-800" href="project.php">ข้อมูลโครงการ</a>
                </div>


                <!-- Content Row -->
                <div class="row">
                    <div class="col-12 order-2 order-md-3 order-lg-2">
                        <div class="card">
                            <div class="card-header text-center4">
                                <h3><?php echo $header; ?>ข้อมูลโครงการ</h3>
                            </div>
                            <div class="card-body">
                                <form id="formAccountSettings" action="../API/api_project.php?xCase=<?php echo $case ?>&id=<?php echo $id ?>" method="POST">
                                    <div class="row">
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="project_name" class="form-label">ชื่อโครงการ</label>
                                            <input type="text" class="form-control" name="project_name" id="project_name" placeholder="ชื่อ" value="<?php echo ($case == 1) ? '' : $row['project_name'] ?>" <?php echo ($case == '3') ? 'readonly' : 'required' ?> <?php echo ($case == 4) ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="emp_id" class="form-label">ลูกค้า</label>
                                            <select class="form-select" aria-label="Default select example" name="cus_id" id="cus_id" <?php echo ($case == '3' || $case == '4') ? 'disabled' : 'required' ?>>
                                                <option selected disabled>เลือกลูกค้า </option>
                                                <?php
                                                foreach ($result_ as $rowselect) {
                                                    $isSelected = ($rowselect['cus_id'] == $row['cus_id']) ? 'selected' : '';
                                                ?>
                                                    <option value="<?php echo $rowselect['cus_id']; ?>" <?php echo $isSelected; ?>>
                                                        <?php echo $rowselect['cus_firstname'], ' ', $rowselect['cus_lastname']; ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="project_start" class="form-label">วันที่เริ่มโครงการ</label>
                                            <input type="date" class="form-control" name="project_start" id="project_start" value="<?php echo ($case == 1) ? '' : $row['project_start'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="project_end" class="form-label">วันที่สิ้นสุดโครงการ</label>
                                            <input type="date" class="form-control" name="project_end" id="project_end" value="<?php echo ($case == 1) ? '' : $row['project_end'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="project_valueprice" class="form-label">มูลค่าโครงการ</label>
                                            <input type="number" class="form-control" name="project_valueprice" id="project_valueprice" placeholder="ป้อนมูลค่าโครงการ" value="<?php echo ($case == 1) ? '' : $row['project_valueprice'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="cus_id" class="form-label">ผู้ดูแลโครงการ</label>
                                            <select class="form-select" aria-label="Default select example" name="emp_id" id="emp_id" <?php echo ($case == '3' || $case == '4') ? 'disabled' : 'required' ?>>
                                                <option value="" hidden>เลือกพนักงาน </option>
                                                <?php
                                                foreach ($result_emp as $rowselect) {
                                                    $isSelected = ($rowselect['emp_id'] == $row['emp_id']) ? 'selected' : '';
                                                ?>
                                                    <option value="<?php echo $rowselect['emp_id']; ?>" <?php echo $isSelected; ?>>
                                                        <?php echo $rowselect['emp_firstname'], ' ', $rowselect['emp_lastname']; ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="" class="form-label">สถานะโครงการ</label>
                                            <select class="form-select" aria-label="Default select example" name="project_status" id="project_status" <?php echo ($case == '3' || $case == '4') ? 'disabled' : 'required' ?>>
                                                <option value="" hidden>
                                                    <?php echo ($case == 1) ? 'เลือกสถานะ' : $row['status'] ?></option>
                                                <option value="0">ยกเลิก</option>
                                                <option value="1">อยู่ระหว่างดำเนินการ</option>
                                                <option value="2">ปิดโครงการ</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-center mt-2">
                                        <?php
                                        echo ($case == '1') ?
                                            '<a href="project.php" class="btn btn-secondary mx-3">กลับ</a><button type="submit" name="submit_frm" class="btn btn-success">บันทึก</button> ' : (($case == '2') ?
                                                '<a href="project.php" class="btn btn-secondary mx-3">กลับ</a><button type="submit" name="submit_frm" class="btn btn-warning">บันทึก</button>' : (($case == '3') ?
                                                    '<a href="project.php" class="btn btn-secondary mx-3">กลับ</a><button type="submit" name="submit_frm" class="btn btn-danger">ลบ</button>' : (($case == '4') ?
                                                        '<a href="project.php" class="btn btn-secondary mx-3">กลับ</a>' : '')))
                                        ?>
                                        <!-- <button type="submit" name="submit" class="btn btn-success">บันทึก</button> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--/ Total Revenue -->
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <script>
            $(document).ready(function() {
                $("#formAccountSettings").submit(function(e) {
                    e.preventDefault();

                    let formUrl = $(this).attr("action");
                    let reqMethod = $(this).attr("method");
                    let formData = $(this).serialize();

                    $.ajax({
                        url: formUrl,
                        type: reqMethod,
                        data: formData,
                        success: function(data) {
                            // console.log("Success", data);
                            let result = JSON.parse(data);

                            if (result.status == "success") {
                                // console.log("Success", result);
                                Swal.fire({
                                    icon: result.status,
                                    title: result.title,
                                    text: result.message,
                                    showConfirmButton: false,
                                    timer: 2500
                                }).then(function() {
                                    window.location.href = "project.php";
                                });
                            } else {
                                Swal.fire(result.title, result.message, result
                                    .status)
                            }
                        }
                    })
                })
            })
        </script>

        <!-- Footer -->
        <?php include("footer.php"); ?>
        <!-- / Footer -->