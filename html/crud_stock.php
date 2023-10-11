<?php
include("header.php");

$case = $_GET['xCase'];
if ($case == '1') {
    $header = 'เพิ่ม';
    $id = '';
} else if ($case  == '2') {
    $header = 'แก้ไข';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM stock WHERE s_id ='$id' ");
    $row = mysqli_fetch_array($result);
    // print_r(md5($row['password']));
} else if ($case  == '3') {
    $header = 'ลบ';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM stock WHERE s_id ='$id' ");
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
                    <a class="h3 mb-0 text-gray-800" href="stock.php">ข้อมูลสินค้า</a>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col-12 order-2 order-md-3 order-lg-2 mb-4">
                        <div class="card">
                            <div class="card-header text-center">
                                <h3><?php echo $header; ?>ข้อมูลสินค้า</h3>
                            </div>
                            <div class="card-body">
                                <form id="formAccountSettings" action="../API/api_stock.php?xCase=<?php echo $case ?>&id=<?php echo $id ?>" method="POST">
                                    <div class="row">
                                        <div class="mb-2 col-lg-8 col-md-6 col-ms-12">
                                            <label for="s_name" class="form-label">สินค้า</label>
                                            <input type="text" class="form-control" name="s_name" id="s_name" placeholder="Enter product name" value="<?php echo ($case == 1) ? '' : $row['s_name'] ?>" <?php echo ($case == '3') ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-2 col-md-6 col-ms-12">
                                            <label for="s_price" class="form-label">ราคา/หน่วย</label>
                                            <input type="text" class="form-control" name="s_price" id="s_price" placeholder="0.00" value="<?php echo ($case == 1) ? '' : $row['s_price'] ?>" <?php echo ($case == '3') ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-2 col-md-6 col-ms-12">
                                            <label for="s_unit" class="form-label">หน่วยนับ</label>
                                            <input type="text" class="form-control" name="s_unit" id="s_unit" placeholder="Enter Product description" value="<?php echo ($case == 1) ? '' : $row['s_unit'] ?>" <?php echo ($case == '3') ? 'readonly' : 'required' ?>>
                                        </div>
                                    </div>
                                    <div class="mt-2 text-center">
                                        <?php
                                        echo ($case == '1') ?
                                            '<button type="submit" name="submit_pro" class="btn btn-success">บันทึก</button> ' : (($case == '2') ?
                                                '<button type="submit" name="submit_pro" class="btn btn-warning">บันทึก</button>' : (($case == '3') ?
                                                    '<button type="submit" name="submit_pro" class="btn btn-danger">ลบ</button>' : ''))
                                        ?>
                                        <!-- <button type="submit" name="submit" class="btn btn-success">บันทึก</button> -->
                                        <a href="stock.php" class="btn btn-secondary ms-3">Cancel</a>
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
                                    window.location.href = "stock.php";
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