<?php
include("header.php");

$case = $_GET['xCase'];
if ($case == '1') {
    $header = 'เพิ่ม';
    $id = '';
} else if ($case  == '2') {
    $header = 'แก้ไข';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM customer WHERE cus_id ='$id' ");
    $row = mysqli_fetch_array($result);
    // print_r(md5($row['password']));
} else if ($case  == '3') {
    $header = 'ลบ';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM customer WHERE cus_id ='$id' ");
    $row = mysqli_fetch_array($result);
} else if ($case  == '4') {
    $header = 'รายละเอียด';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM customer WHERE cus_id ='$id' ");
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
                    <a class="h3 mb-0 text-gray-800" href="customer.php">ข้อมูลลูกค้า</a>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col-12 order-2 order-md-3 order-lg-2 mb-4">
                        <div class="card">
                            <div class="card-header text-center">
                                <h3><?php echo $header; ?>ข้อมูลลูกค้า</h3>
                            </div>
                            <div class="card-body">
                                <form id="formAccountSettings" action="../API/api_customer.php?xCase=<?php echo $case ?>&id=<?php echo $id ?>" method="POST">
                                    <div class="row">
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="cus_firstname" class="form-label">ชื่อ</label>
                                            <input type="text" class="form-control" name="cus_firstname" id="cus_firstname" placeholder="ชื่อ" value="<?php echo ($case == 1) ? '' : $row['cus_firstname'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="cus_lastname" class="form-label">นามสกุล</label>
                                            <input type="text" class="form-control" name="cus_lastname" id="cus_lastname" placeholder="นามสกุล" value="<?php echo ($case == 1) ? '' : $row['cus_lastname'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="cus_address" class="form-label">ที่อยู่</label>
                                            <input type="text" class="form-control" name="cus_address" id="cus_address" placeholder="ที่อยู่" value="<?php echo ($case == 1) ? '' : $row['cus_address'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="cus_subdis" class="form-label">ตำบล</label>
                                            <input type="text" class="form-control" name="cus_subdis" id="cus_subdis" placeholder="ตำบล" value="<?php echo ($case == 1) ? '' : $row['cus_subdis'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="cus_district" class="form-label">อำเภอ</label>
                                            <input type="text" class="form-control" name="cus_district" id="cus_district" placeholder="อำเภอ" value="<?php echo ($case == 1) ? '' : $row['cus_district'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="cus_province" class="form-label">จังหวัด</label>
                                            <input type="text" class="form-control" name="cus_province" id="cus_province" placeholder="จังหวัด" value="<?php echo ($case == 1) ? '' : $row['cus_province'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="cus_postcode" class="form-label">ไปรษณีย์</label>
                                            <input type="text" class="form-control" name="cus_postcode" id="cus_postcode" placeholder="ไปรษณีย์" value="<?php echo ($case == 1) ? '' : $row['cus_postcode'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="cus_phone" class="form-label">เบอร์โทรศัพท์</label>
                                            <input type="text" class="form-control" name="cus_phone" id="cus_phone" placeholder="เบอร์โทรศัพท์" value="<?php echo ($case == 1) ? '' : $row['cus_phone'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="cus_email" class="form-label">อีเมล</label>
                                            <input type="email" class="form-control" name="cus_email" id="cus_email" placeholder="อีเมล" value="<?php echo ($case == 1) ? '' : $row['cus_email'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                        </div>
                                    </div>
                                    <div class="mt-2 text-center">
                                        <?php
                                        echo ($case == '1') ?
                                            '<button type="submit" name="submit_frm" class="btn btn-success">บันทึก</button> ' : (($case == '2') ?
                                                '<button type="submit" name="submit_frm" class="btn btn-warning">บันทึก</button>' : (($case == '3') ?
                                                    '<button type="submit" name="submit_frm" class="btn btn-danger">ลบ</button>' : ''))
                                        ?>
                                        <!-- <button type="submit" name="submit" class="btn btn-success">บันทึก</button> -->
                                        <a href="customer.php" class="btn btn-secondary ms-3">ยกเลิก</a>
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
                                    window.location.href = "customer.php";
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