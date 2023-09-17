<?php
include("header.php");

$case = $_GET['xCase'];
if ($case == '1') {
    $header = 'เพิ่ม';
    $id = '';
} else if ($case  == '2') {
    $header = 'แก้ไข';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM project_close WHERE headcode ='$id' ");
    $row = mysqli_fetch_array($result);
    // print_r(md5($row['password']));
} else if ($case  == '3') {
    $header = 'ลบ';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM project_close WHERE headcode ='$id' ");
    $row = mysqli_fetch_array($result);
} else if ($case  == '4') {
    $header = 'รายละเอียด';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM `project_close` JOIN employee USING(emp_id) JOIN project USING(project_id) WHERE project_close.void = 0");
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
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <a class="h3 mb-0 text-gray-800" href="project_close.php">บันทึกปิดโครงการ</a>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col-12 order-2 order-md-3 order-lg-2 mb-4">
                        <div class="card">
                            <div class="card-header text-center">
                                <h3><?php echo $header; ?>แบบบันทึกปิดโครงการ</h3>
                            </div>
                            <div class="card-body">
                                <form id="formAccountSettings" action="../API/api_close.php?xCase=<?php echo $case ?>&id=<?php echo $id ?>" method="POST">
                                    <div class="row">
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="headcode" class="form-label">เลขที่เอกสาร</label>
                                            <input type="text" class="form-control" name="headcode" id="headcode" placeholder="" value="<?php echo ($case == 1) ? '' : $row['headcode'] ?>" <?php echo ($case == '3' || ($case == 4)) ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="dateclose" class="form-label">วันที่ปิดโครงการ</label>
                                            <input type="date" class="form-control" name="dateclose" id="dateclose" placeholder="" value="<?php echo ($case == 1) ? '' : $row['dateclose'] ?>" <?php echo ($case == '3' || ($case == 4)) ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="project_id" class="form-label">รหัสโครงการ</label>
                                            <input type="text" class="form-control" name="project_id" id="project_id" placeholder="" value="<?php echo ($case == 1) ? '' : $row['project_id'] ?>" <?php echo ($case == '3' || ($case == 4)) ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="cost" class="form-label">ต้นทุน</label>
                                            <input type="text" class="form-control" name="cost" id="cost" placeholder="" value="<?php echo ($case == 1) ? '' : $row['cost'] ?>" <?php echo ($case == '3' || ($case == 4)) ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="pay" class="form-label">ค่าใช้จ่าย</label>
                                            <input type="text" class="form-control" name="pay" id="pay" placeholder="" value="<?php echo ($case == 1) ? '' : $row['pay'] ?>" <?php echo ($case == '3' || ($case == 4)) ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="emp_id" class="form-label">รหัสพนักงาน</label>
                                            <input type="text" class="form-control" name="emp_id" id="emp_id" placeholder="" value="<?php echo ($case == 1) ? '' : $row['emp_id'] ?>" <?php echo ($case == '3' || ($case == 4)) ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="comment" class="form-label">หมายเหตุ</label>
                                            <input type="text" class="form-control" name="comment" id="comment" placeholder="" value="<?php echo ($case == 1) ? '' : $row['comment'] ?>" <?php echo ($case == '3' || ($case == 4)) ? 'readonly' : 'required' ?>>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <?php
                                        echo ($case == '1') ?
                                            '<button type="submit" name="submit_pro" class="btn btn-success">บันทึก</button> ' : (($case == '2') ?
                                                '<button type="submit" name="submit_pro" class="btn btn-warning">บันทึก</button>' : (($case == '3') ?
                                                    '<button type="submit" name="submit_pro" class="btn btn-danger">ลบ</button>' : ''))
                                        ?>
                                        <!-- <button type="submit" name="submit" class="btn btn-success">บันทึก</button> -->
                                        <a href="project_close.php" class="btn btn-secondary ms-3">ยกเลิก</a>
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
                                    window.location.href = "project_close.php";
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