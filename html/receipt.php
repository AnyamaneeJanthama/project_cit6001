<?php
include("connect.php");
$data = mysqli_query($conn, "SELECT * ,if(status = 0 ,'ยกเลิก','ปกติ') AS status  FROM `project_hd` JOIN project USING(project_id) WHERE project_hd.void = 0 ORDER BY headcode");

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
                    <h1 class="h3 mb-0 text-gray-800">ข้อมูลค่าใช้จ่ายโครงการ</h1>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col-12 order-2 order-md-3 order-lg-2 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-end">
                                    <a href="crud_receipt.php?xCase=1" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i> เพิ่มข้อมูล</a>
                                </div>
                            </div>
                            <div class="">
                                <div class="card-body">
                                    <table id="myTable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th width="150px">ชื่อโครงการ</th>
                                                <th>สถานะ</th>
                                                <th class="text-center" style="width: 200px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (mysqli_num_rows($data) > 0) {
                                                while ($row = mysqli_fetch_assoc($data)) {
                                            ?>
                                                    <tr>
                                                        <th class="text-center" style="width: 50px;">
                                                            <?php echo $row['headcode']; ?></th>
                                                        <th><?php echo $row['project_name'] ?>
                                                        <th><?php echo $row['status'] ?>
                                                        </th>
                                                        <td class="text-center">
                                                            <a href="crud_receipt.php?xCase=4&id=<?php echo $row['headcode'] ?>" name="btn_view" class="btn btn-info"><i class="fa-solid fa-address-card"></i></a>
                                                            <a href="crud_receipt.php?xCase=2&id=<?php echo $row['headcode'] ?>" name="btn_edit" class="btn btn-warning edit_sale"><i class="fa-solid fa-pen-to-square"></i></a>
                                                            <a href="crud_receipt.php?xCase=3&id=<?php echo $row['headcode'] ?>" name="btn_delete" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
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


            </div>
            <!-- /.container-fluid -->

            <script>
                // เลือกรหัสโครงการ
                var projectSelect = document.getElementById('project_id');
                // ช่องแสดงชื่อโครงการ
                var projectNameInput = document.getElementById('project_name_display');
                var projectNameInputID = document.getElementById('project_id_display');
                var projectNameInputprice = document.getElementById('project_price_display');

                // ใช้ addEventListener เพื่อดักเหตุการณ์การเลือกรหัสโครงการ
                projectSelect.addEventListener('change', function() {
                    // หาค่าที่ถูกเลือก
                    var selectedOption = projectSelect.options[projectSelect.selectedIndex];
                    var selectedProjectID = selectedOption.value; // รหัสโครงการที่ถูกเลือก

                    // ส่งคำขอ AJAX ไปยังเซิร์ฟเวอร์เพื่อดึงชื่อโครงการ
                    $.ajax({
                        url: '../../API/api_receipt.php?xCase=4&id=' + selectedProjectID,
                        type: 'GET',
                        success: function(data) {
                            var projectData = JSON.parse(data);
                            projectNameInputID.value = selectedOption.value;
                            projectNameInput.value = projectData.project_fullname;
                            projectNameInputprice.value = projectData.project_valueprice;
                        }
                    });

                });

                // multi insrt
                function addInputFields() {
                    const table = document.querySelector('table');

                    // Check if a tbody element exists, and create one if it doesn't
                    let tbody = table.querySelector('tbody');
                    if (!tbody) {
                        tbody = document.createElement('tbody');
                        table.appendChild(tbody);
                    }

                    const newRow = document.createElement('tr');

                    const fieldNames = ['s_id', 'qty', 's_price', 'totalprice'];
                    const field_holder = ['รหัสสินค้า', 'จำนวน', 'ราคา/หน่วย', 'จำนวนเงิน'];

                    for (let i = 0; i < fieldNames.length; i++) {
                        const newCell = document.createElement('td');
                        const newInput = document.createElement('input');
                        newInput.type = 'text';
                        newInput.name = `${fieldNames[i]}[]`;
                        newInput.className = 'form-control';
                        newInput.placeholder = `${field_holder[i]}`;
                        newCell.appendChild(newInput);
                        newRow.appendChild(newCell);
                    }

                    tbody.appendChild(newRow);
                }
            </script>

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