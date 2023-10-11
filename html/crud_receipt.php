<?php
include("header.php");

$case = $_GET['xCase'];
if ($case == '1') {
    $header = 'บันทึก';
    $id = '';
    $result_ = mysqli_query($conn, "SELECT * FROM project WHERE void = 0");
    // option stock
    $stock = mysqli_query($conn, "SELECT * FROM stock WHERE void = 0");
    $stockItems = array();
    while ($rowstock = mysqli_fetch_array($stock)) {
        // Assuming you have columns 'id' and 'name' in your database
        $item = array(
            's_id' => $rowstock['s_id'],
            's_name' => $rowstock['s_name']
        );

        // Add the item to the stockItems array
        $stockItems[] = $item;
    }
    // Convert the $stockItems array to a JSON array
    $stockItemsJSON = json_encode($stockItems); // Convert the $stockItems array to a JSON array
} else if ($case  == '3') {
    $header = 'ลบ';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM project_hd WHERE headcode ='$id' ");
    $result_ = mysqli_query($conn, "SELECT * FROM project JOIN customer USING(cus_id) WHERE project_id AND project.void = 0");
    $result_hd = mysqli_query($conn, "SELECT * FROM `project_hd` JOIN project USING(project_id) JOIN customer USING(cus_id) WHERE project_hd.void = 0 AND project_hd.headcode='$id'");
    $result_value = mysqli_query($conn, "SELECT * FROM `project_hd` JOIN project_desc USING(headcode) JOIN stock USING(s_id) WHERE project_hd.void =0 AND project_hd.headcode ='$id' ");
    $row = mysqli_fetch_array($result);
    $row_ = mysqli_fetch_array($result_hd);
    // $nn = mysqli_query($conn, "SELECT *,concat(SUBSTRING(datesave,9,2),SUBSTRING(datesave,6,2),headcode) as no_ FROM `project_hd`");
    // $no = mysqli_fetch_array($nn);
} else if ($case  == '4') {
    $header = 'รายละเอียด';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM project_hd WHERE headcode ='$id' ");
    $result_ = mysqli_query($conn, "SELECT * FROM project JOIN customer USING(cus_id) WHERE project_id AND project.void = 0");
    $result_hd = mysqli_query($conn, "SELECT * FROM `project_hd` JOIN project USING(project_id) JOIN customer USING(cus_id) WHERE project_hd.void = 0 AND project_hd.headcode='$id'");
    $result_value = mysqli_query($conn, "SELECT * FROM `project_hd` JOIN project_desc USING(headcode) JOIN stock USING(s_id) WHERE project_hd.void =0 AND project_hd.headcode ='$id' ");
    $row = mysqli_fetch_array($result);
    $row_ = mysqli_fetch_array($result_hd);
    // $nn = mysqli_query($conn, "SELECT *,concat(SUBSTRING(datesave,9,2),SUBSTRING(datesave,6,2),headcode) as no_ FROM `project_hd`");
    // $no = mysqli_fetch_array($nn);
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
            <!-- End of Topbar --

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <a class="h3 mb-0 text-gray-800" href="receipt.php">ข้อมูลค่าใช้จ่ายโครงการ</a>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col-12 order-2 order-md-3 order-lg-2 mb-4">
                        <div class="card mb-3">
                            <div class="text-end mt-3 mr-3">
                                <?php echo ($case == 4 || $case == 3) ? "NO." . $row['headcode'] : '' ?>
                            </div>
                            <div class="card-header text-center">
                                <h3><?php echo $header; ?>ข้อมูลค่าใช้จ่ายโครงการ</h3>
                            </div>
                            <div class="card-body">
                                <form id="formAccountSettings" action="../API/api_receipt.php?xCase=<?php echo $case ?>&id=<?php echo $id ?>" method="POST">
                                    <div class="row">
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="datesave" class="form-label">วันที่บันทึก</label>
                                            <input type="date" class="form-control" name="datesave" id="datesave" value="<?php echo ($case == 1) ? date('Y-m-d') : $row['datesave'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="receiptcode" class="form-label">เลขที่ใบเสร็จ</label>
                                            <input type="number" maxlength="4" class="form-control" name="receiptcode" id="receiptcode" placeholder="เลขที่ใบเสร็จ" value="<?php echo ($case == 1) ? '' : $row['receiptcode'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="datereceipt" class="form-label">วันที่ใบเสร็จ</label>
                                            <input type="date" class="form-control" name="datereceipt" id="datereceipt" placeholder="วันที่ใบเสร็จ" value="<?php echo ($case == 1) ? date('Y-m-d') : $row['datereceipt'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                        </div>
                                        <!-- <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="project_id" class="form-label">รหัสโครงการ</label>
                                            <input type="text" class="form-control" id="project_id_display" placeholder="ชื่อโครงการ" readonly value="<?php echo ($case == 1) ? '' : $row['project_id'] ?>" <?php echo ($case == '3' || $case == '4') ? 'readonly' : 'required' ?>>
                                            
                                        </div> -->
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="project_id" class="form-label">โครงการ</label>
                                            <select class="form-select" aria-label="Default select example" name="project_id" id="project_id" value="<?php echo ($case == 1) ? '' : $row['project_id'] ?>" <?php echo ($case == '3' || $case == '4') ? 'disabled' : 'required' ?>>
                                                <option selected disabled>เลือกโครงการ</option>
                                                <?php
                                                foreach ($result_ as $rowselect) {
                                                    $isSelected = ($rowselect['project_id'] == $row['project_id']) ? 'selected' : '';
                                                ?>
                                                    <option value="<?php echo $rowselect['project_id']; ?>" <?php echo $isSelected; ?>>
                                                        <?php echo $rowselect['project_name']; ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="cus_id" class="form-label">ชื่อลูกค้า</label>
                                            <input type="text" class="form-control" name="cus_id" id="project_name_display" value="<?php echo ($case == '3' || $case == '4') ?  $row_['cus_firstname'] . " " . $row_['cus_lastname']  : '' ?>" readonly>
                                        </div>
                                        <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                            <label for="project_valueprice" class="form-label">มูลค่าโครงการ</label>
                                            <input type="text" class="form-control" name="project_valueprice" id="project_price_display" value="<?php echo ($case == '3' || $case == '4') ?  $row_['project_valueprice'] : '' ?>" readonly>
                                        </div>
                                    </div>

                                    <table class="table my-2">
                                        <thead>
                                            <tr>
                                                <th>รหัสสินค้า</th>
                                                <th>จำนวน</th>
                                                <th>ราคา/หน่วย</th>
                                                <th>จำนวนเงิน</th>
                                                <?php echo ($case == 1) ? '<th><button type="button" class="btn btn-info" onclick="addInputFields()">เพิ่ม</button></th>' : ''; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($case == 1) {
                                                echo '
                                                   ';
                                            } elseif ($case == 4 || $case == 3) {
                                                $sum = 0;

                                                foreach ($result_value as $rowselect) {
                                                    $sum += $rowselect["totalprice"];
                                            ?>
                                                    <tr>
                                                        <td><input type="text" class="form-control" readonly value="<?php echo $rowselect["s_id"] . " - " . $rowselect["s_name"] ?>">
                                                        </td>
                                                        <td><input type="text" class="form-control" readonly value="<?php echo $rowselect["qty"] ?>"></td>
                                                        <td><input type="text" class="form-control" readonly value="<?php echo $rowselect["s_price"] ?>"></td>
                                                        <td><input type="text" class="form-control" readonly value="<?php echo $rowselect["totalprice"] ?>"></td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th class="text-center">รวมมูลค่าสินค้า</th>
                                                    <th class="text-center" id="grandTotal">
                                                        <?php echo ($case == 4) ? $sum : '' ?></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                        </tbody>
                                    </table>
                                    <div class="mt-2">
                                        <?php
                                        echo ($case == '1') ?
                                            '<button type="submit" name="submit_frm" class="btn btn-success">บันทึก</button> ' : (($case == '2') ?
                                                '<button type="submit" name="submit_frm" class="btn btn-warning">บันทึก</button>' : (($case == '3') ?
                                                    '<button type="submit" name="submit_frm" class="btn btn-danger">ลบ</button>' : ''))
                                        ?>
                                        <!-- <button type="submit" name="submit" class="btn btn-success">บันทึก</button> -->
                                        <a href="receipt.php" class="btn btn-secondary ms-3">ยกเลิก</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <!--/ Total Revenue -->
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <script>
                function updateRowResult(row) {
                    const num1 = parseFloat(row.querySelector('.qty').value) || 0;
                    const num2 = parseFloat(row.querySelector('.s_price').value) || 0;
                    const result = num1 * num2;

                    row.querySelector('.totalprice').value = result;
                }

                // เพิ่มrow tableใหม่
                function updateRowResult(row) {
                    const num1 = parseFloat(row.querySelector('.qty').value) || 0;
                    const num2 = parseFloat(row.querySelector('.s_price').value) || 0;
                    const result = num1 * num2;

                    row.querySelector('.totalprice').value = result;

                    // รวมค่า
                    calculateGrandTotal();
                }

                // รวมค่าทุกrow
                function calculateGrandTotal() {
                    const totalpriceInputs = document.querySelectorAll('.totalprice');
                    let grandTotal = 0;

                    totalpriceInputs.forEach(input => {
                        const value = parseFloat(input.value) || 0;
                        grandTotal += value;
                    });

                    document.getElementById('grandTotal').textContent = grandTotal;
                }

                // เพิ่ม row table ใหม่
                function addInputFields() {
                    const table = document.querySelector('table');

                    // Check if there's already a tbody; if not, create one
                    let tbody = table.querySelector('tbody');
                    if (!tbody) {
                        tbody = document.createElement('tbody');
                        table.appendChild(tbody);
                    }

                    const newRow = document.createElement('tr');

                    // Create an array for the field names and placeholders
                    const fieldNames = ['s_id', 'qty', 's_price', 'totalprice'];
                    const field_holder = ['รหัสสินค้า', 'จำนวน', 'ราคา/หน่วย', 'จำนวนเงิน'];

                    for (let i = 0; i < fieldNames.length; i++) {
                        const newCell = document.createElement('td');

                        if (fieldNames[i] === 's_id') {
                            // Create a <select> element for "รหัสสินค้า"
                            const newSelect = document.createElement('select');
                            newSelect.classList.add('form-select', fieldNames[i]);
                            newSelect.name = `${fieldNames[i]}[]`;
                            newSelect.id = `${fieldNames[i]}`;
                            newSelect.setAttribute('placeholder', field_holder[i]);

                            // Parse the JSON array from PHP into a JavaScript array
                            const stockItems = JSON.parse('<?php echo $stockItemsJSON; ?>');

                            // Now, you can use the stockItems array to populate your <select> element
                            stockItems.forEach(item => {
                                const option = document.createElement('option');
                                option.value = item.s_id;
                                option.textContent = `${item.s_id} - ${item.s_name}`;
                                newSelect.appendChild(option);
                            });


                            newCell.appendChild(newSelect);
                        } else {
                            // Create input elements for other fields
                            const newInput = document.createElement('input');
                            newInput.type = 'number';
                            newInput.name = `${fieldNames[i]}[]`;
                            newInput.classList.add('form-control', fieldNames[i]);
                            newInput.placeholder = field_holder[i];

                            if (fieldNames[i] === 'totalprice') {
                                newInput.type = 'text';
                                newInput.readOnly = true;
                            }

                            newCell.appendChild(newInput);
                        }

                        newRow.appendChild(newCell);

                        // Add an event listener to update the "จำนวนเงิน" when "จำนวน" or "ราคา/หน่วย" changes
                        if (fieldNames[i] === 'qty' || fieldNames[i] === 's_price') {
                            newCell.lastChild.addEventListener('input', function() {
                                updateRowResult(newRow);
                            });
                        }
                    }

                    // Create a delete button
                    const deleteButtonCell = document.createElement('td');
                    const deleteButton = document.createElement('button');
                    deleteButton.type = 'button';
                    deleteButton.classList.add('btn', 'btn-danger');
                    deleteButton.textContent = 'ลบ';
                    deleteButton.addEventListener('click', function() {
                        table.deleteRow(newRow.rowIndex);
                        calculateGrandTotal();
                    });
                    deleteButtonCell.appendChild(deleteButton);
                    newRow.appendChild(deleteButtonCell);

                    tbody.appendChild(newRow);
                }
            </script>

            <script>
                // เลือกรหัสโครงการ
                var projectSelect = document.getElementById('project_id');
                // ช่องแสดงชื่อโครงการ
                var projectNameInput = document.getElementById('project_name_display');
                var projectNameInputprice = document.getElementById('project_price_display');

                // ใช้ addEventListener เพื่อดักเหตุการณ์การเลือกรหัสโครงการ
                projectSelect.addEventListener('change', function() {
                    // หาค่าที่ถูกเลือก
                    var selectedOption = projectSelect.options[projectSelect.selectedIndex];
                    var selectedProjectID = selectedOption.value; // รหัสโครงการที่ถูกเลือก

                    // ส่งคำขอ AJAX ไปยังเซิร์ฟเวอร์เพื่อดึงชื่อโครงการ
                    $.ajax({
                        url: '../API/api_receipt.php?xCase=4&id=' + selectedProjectID,
                        type: 'GET',
                        success: function(data) {
                            var projectData = JSON.parse(data);
                            projectNameInput.value = projectData.project_fullname;
                            projectNameInputprice.value = projectData.project_valueprice;
                        }
                    });

                });
            </script>

            <!-- <script>
                var stockSelect = document.getElementById('s_id');
                var stockPriceInput = document.getElementById('stock_price_display');

                stockSelect.addEventListener('change', function() {
                    var selectedOption = stockSelect.options[stockSelect.selectedIndex];
                    var selectedStockID = selectedOption.value;

                    $.ajax({
                        url: '../API/api_receipt.php?xCase=5&id=' + selectedStockID,
                        type: 'GET',
                        success: function(data) {
                            var stockData = JSON.parse(data);
                            stockPriceInput.value = stockData.s_price;
                        }
                    });

                });
            </script> -->

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
                                        window.location.href = "receipt.php";
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