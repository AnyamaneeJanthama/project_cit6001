<?php
include("connect.php");
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate the input (you can add more validation as needed)
    if (empty($username) || empty($password)) {
        echo '<script>alert("กรุณากรอกข้อมูลให้ครบทุกช่อง");</script>';
    } else {
        // Query the database to check if the username exists
        $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // Login successful
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit; // Important to stop further execution
        } else {
            // Login failed
            echo '<script>alert("เข้าสู่ระบบไม่สำเร็จ");</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>CIT6001_Project</title>

    <meta name="description" content="" />

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.css" rel="stylesheet">



    <!-- Highcharts library -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <!-- Datatable -->
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- font-awesome -->
    <script src="https://kit.fontawesome.com/a19fde44b7.js" crossorigin="anonymous"></script>

    <!-- export excel:XLS -->
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">

    <!-- export excel:XLS -->
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

</head>

<body>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <section class="vh-100 d-flex justify-content-center align-items-center">
                        <div class="container-fluid h-custom">
                            <div class="row d-flex justify-content-center align-items-center h-100">
                                <div class="col-md-9 col-lg-6 col-xl-5 my-4 text-center">
                                    <img src="https://scontent.fbkk10-1.fna.fbcdn.net/v/t1.15752-9/387549299_209073598746914_3001941152862670117_n.png?_nc_cat=103&ccb=1-7&_nc_sid=ae9488&_nc_ohc=8L71i1QxpvIAX_TzBRv&_nc_ht=scontent.fbkk10-1.fna&oh=03_AdQ3JUe6A9538Df_CiYqwx-NyxQk3as1bcY_dNzv8gCFxw&oe=654B4D1D" class="img-fluid" alt="Sample image" />
                                </div>
                                <div class="col-md-8 col-lg-6 col-xl-4 my-4">
                                    <form method="post">
                                        <div class="text-center my-4">
                                            <div class="fs-1 fw-bold">Admin Project Login</div>
                                        </div>
                                        <!-- User input -->
                                        <div class="form-outline mb-4">
                                            <label class="form-label fs-6" for="username">ชื่อผู้ใช้</label>
                                            <input type="text" id="text" name="username" class="form-control form-control-lg fs-6" placeholder="ป้อนชื่อผู้ใช้" require />
                                        </div>

                                        <!-- Password input -->
                                        <div class="form-outline mb-3">
                                            <label class="form-label fs-6" for="password">รหัสผ่าน</label>
                                            <input type="password" id="password" name="password" class="form-control form-control-lg fs-6" placeholder="ป้อนรหัสผ่าน" require />
                                        </div>

                                        <div class="text-center text-lg-start mt-4 ">
                                            <button type="submit" type="button" class="btn btn-primary btn-lg fs-6 px-5">เข้าสู่ระบบ</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </section>
                    <!-- Content Row -->


                </div>
                <!-- End of Main Content -->
                <!-- Footer -->
                <?php include("footer.php"); ?>
                <!-- / Footer -->