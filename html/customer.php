<?php
include("connect.php");
$data = mysqli_query($conn, "SELECT * from customer WHERE void = 0 ORDER BY cus_id");
include("header.php");

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
                    <h1 class="h3 mb-0 text-gray-800">ข้อมูลลูกค้า</h1>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col-12 order-2 order-md-3 order-lg-2 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-end">
                                    <a href="crud_customer.php?xCase=1" class="btn btn-primary"><i
                                            class="fa-solid fa-plus me-2"></i> เพิ่มข้อมูล</a>
                                </div>
                            </div>
                            <div class="">
                                <div class="card-body">
                                    <table id="myTable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="150px">ชื่อ-นามสกุล</th>
                                                <th>ที่อยู่</th>
                                                <th style="width: 130px;">เบอร์ที่ติดต่อ</th>
                                                <th>อีเมล</th>
                                                <th class="text-center" style="width: 180px;">จัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (mysqli_num_rows($data) > 0) {
                                                while ($row = mysqli_fetch_assoc($data)) {
                                            ?>
                                            <tr>
                                                <th><?php echo $row['cus_firstname'], " ", $row['cus_lastname']; ?></th>
                                                <td><?php echo $row['cus_address'], " ", $row['cus_subdis'], " ", $row['cus_district'], " ", $row['cus_province'], " ", $row['cus_postcode']; ?>
                                                </td>
                                                <td><?php echo $row['cus_phone']; ?></td>
                                                <td><?php echo $row['cus_email']; ?></td>
                                                <td class="text-center">
                                                    <a href="crud_customer.php?xCase=4&id=<?php echo $row['cus_id'] ?>"
                                                        name="btn_view" class="btn btn-info"><i
                                                            class="fa-solid fa-address-card"></i></a>
                                                    <a href="crud_customer.php?xCase=2&id=<?php echo $row['cus_id'] ?>"
                                                        name="btn_edit" class="btn btn-warning edit_sale"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                    <a href="crud_customer.php?xCase=3&id=<?php echo $row['cus_id'] ?>"
                                                        name="btn_delete" class="btn btn-danger"><i
                                                            class="fa-solid fa-trash-can"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--/ Total Revenue -->
                    </div>


                </div>
                <!-- /.container-fluid -->
                <script>
                $.extend(true, $.fn.dataTable.defaults, {
                    "language": {
                        "sProcessing": "กำลังดำเนินการ...",
                        "sLengthMenu": "แสดง _MENU_ แถว",
                        "sZeroRecords": "ไม่พบข้อมูล",
                        "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                        "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                        "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                        "sInfoPostFix": "",
                        "sSearch": "ค้นหา:",
                        "sUrl": "",
                        "oPaginate": {
                            "sFirst": "เิริ่มต้น",
                            "sPrevious": "ก่อนหน้า",
                            "sNext": "ถัดไป",
                            "sLast": "สุดท้าย"
                        }
                    },
                    "lengthMenu": [
                        [10, 15, 20],
                        [10, 15, 20],
                    ],
                });
                $('#myTable').DataTable({
                    // order: [
                    //     [0, 'desc']
                    // ]
                });
                </script>

            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <?php include("footer.php"); ?>
            <!-- / Footer -->