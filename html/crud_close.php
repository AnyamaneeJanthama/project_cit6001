<?php
include("header.php");

$case = $_GET['xCase'];
if ($case == '1') {
    $header = 'เพิ่ม';
    $id = '';
    $result_ = mysqli_query($conn, "SELECT * FROM `project_hd`JOIN project USING(project_id) JOIN employee USING(emp_id) WHERE project_hd.void = 0");
} else if ($case  == '2') {
    $header = 'แก้ไข';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM project_close JOIN employee USING(emp_id) JOIN project USING(project_id) WHERE headcode ='$id' ");
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
            <?php include("topbar.php") ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between">
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
                                            <label for="datereceipt" class="form-label">เลขที่เอกสาร</label>
                                            <select class="form-select" aria-label="Default select example" name="headcode" id="headcode" value="<?php echo ($case == 1) ? '' : $row['project_id'] ?>" <?php echo ($case == '3' || $case == '4') ? 'disabled' : 'required' ?>>
                                                <option selected disabled>เลือกเลขที่เอกสาร</option>
                                                <?php
                                                foreach ($result_ as $rowselect) {
                                                    $isSelected = ($rowselect['headcode'] == $row['headcode']) ? 'selected' : '';
                                                ?>
                                                    <option value="<?php echo $rowselect['headcode']; ?>" <?php echo $isSelected; ?>>
                                                        <?php echo $rowselect['headcode'] . " - " . $rowselect['project_name'] ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="dateclose" class="form-label">วันที่ปิดโครงการ</label>
                                            <input type="date" class="form-control" name="dateclose" id="projectEnd_display" placeholder="" value="<?php echo ($case == 1) ? '' : $row['dateclose'] ?>" <?php echo ($case == '1' || $case == '3' || ($case == 4)) ? 'readonly' : 'required'  ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="project_id" class="form-label">รหัสโครงการ</label>
                                            <input type="text" class="form-control" name="project_id" id="project_id" placeholder="" value="<?php echo ($case == 1) ? '' : $row['project_id'] ?>" <?php echo ($case == '1' || $case == '3' || ($case == 4)) ? 'readonly' : 'required'  ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="cost" class="form-label">ต้นทุน</label>
                                            <input type="text" class="form-control" name="cost" id="project_price_display" placeholder="" value="<?php echo ($case == 1) ? '' : $row['coast'] ?>" <?php echo ($case == '1' || $case == '3' || ($case == 4)) ? 'readonly' : 'required'  ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="pay" class="form-label">ค่าใช้จ่าย</label>
                                            <input type="text" class="form-control" name="pay" id="totalprice_display" placeholder="" value="<?php echo ($case == 1) ? '' : $row['pay'] ?>" <?php echo ($case == '1' || $case == '3' || ($case == 4))  ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="emp_id" class="form-label">รหัสพนักงาน</label>
                                            <input type="text" class="form-control" name="emp_id" id="emp_display" placeholder="" value="<?php echo ($case == 1) ? '' : $row['emp_id'] ?>" <?php echo ($case == '1' || $case == '3' || ($case == 4)) ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="comment" class="form-label">หมายเหตุ</label>
                                            <input type="text" class="form-control" name="comment" id="comment" placeholder="ป้อนหมายเหตุ" value="<?php echo ($case == 1) ? '' : $row['comment'] ?>" <?php echo ($case == '3' || ($case == 4)) ? 'readonly' : '' ?>>
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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
        <script>
            var projectSelect = document.getElementById('headcode');
            var project = document.getElementById('project_id');
            var projectNameInputPrice = document.getElementById('project_price_display');
            var Empname = document.getElementById('emp_display');
            var ProjectEnd = document.getElementById('projectEnd_display');
            var totalprice = document.getElementById('totalprice_display');

            projectSelect.addEventListener('change', function() {
                var selectedOption = projectSelect.options[projectSelect.selectedIndex];
                var selectedProjectID = selectedOption.value; // Get the selected project ID

                $.ajax({
                    url: '../API/api_close.php?xCase=4&id=' + selectedProjectID,
                    type: 'GET',
                    success: function(data) {
                        var projectData = JSON.parse(data);
                        projectNameInputPrice.value = projectData.project_valueprice;
                        Empname.value = projectData.emp_id;
                        project.value = projectData.project_id;
                        ProjectEnd.value = projectData.project_end;
                        totalprice.value = projectData.totalprice;
                    },
                    error: function() {
                        alert("เกิดข้อผิดพลาดในการเรียก API");
                    }
                });
            });
        </script>

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
                            let result = JSON.parse(data);

                            if (result.status == "success") {
                                Swal.fire({
                                    icon: "success",
                                    title: result.title,
                                    text: result.message,
                                    showConfirmButton: false,
                                    timer: 2500
                                }).then(function() {
                                    window.location.href = "project_close.php";
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: result.title,
                                    text: result.message
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: "error",
                                title: "เกิดข้อผิดพลาดในการส่งข้อมูล",
                                text: "โปรดลองอีกครั้ง"
                            });
                        }
                    });
                });
            });
        </script>

        <!-- Footer -->
        <?php include("footer.php"); ?>
        <!-- / Footer -->