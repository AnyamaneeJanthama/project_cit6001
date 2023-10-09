<?php
// Assuming $currentPage holds the name of the current page
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-text mx-3">Admin Project</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo ($currentPage == 'dashboard.php') ? "active" : ""; ?>">
        <a class="nav-link" href="dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt fs-5"></i>
            <span class="fs-6">ภาพรวม</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php echo ($currentPage == 'employee.php' || $currentPage == 'crud_employee.php') ? "active" : ""; ?>">
        <a class="nav-link" href="employee.php">
            <i class="fa-solid fa-user-tie fs-5"></i>
            <span class="fs-6">ข้อมูลพนักงาน</span>
        </a>
    </li>
    <li class="nav-item <?php echo ($currentPage == 'customer.php' || $currentPage == 'crud_customer.php') ? "active" : ""; ?>">
        <a class="nav-link" href="customer.php">
            <i class="fa-duotone fa-users fs-5"></i>
            <span class="fs-6">ข้อมูลลูกค้า</span>
        </a>
    </li>
    <li class="nav-item <?php echo ($currentPage == 'stock.php' || $currentPage == 'crud_stock.php') ? "active" : ""; ?>">
        <a class="nav-link" href="stock.php">
            <i class="fa-solid fa-box fs-5"></i>
            <span class="fs-6">ข้อมูลสินค้า</span>
        </a>
    </li>
    <li class="nav-item <?php echo ($currentPage == 'project.php' || $currentPage == 'crud_project.php') ? "active" : ""; ?>">
        <a class="nav-link" href="project.php">
            <i class="fa-solid fa-file-chart-column fs-5"></i>
            <span class="fs-6">ข้อมูลโครงการ</span>
        </a>
    </li>
    <li class="nav-item <?php echo ($currentPage == 'receipt.php' || $currentPage == 'crud_receipt.php') ? "active" : ""; ?>">
        <a class="nav-link" href="receipt.php">
            <i class="fa-solid fa-file-invoice-dollar fs-5"></i>
            <span class="fs-6">ข้อมูลค่าใช้จ่ายโครงการ</span>
        </a>
    </li>
    <li class="nav-item <?php echo ($currentPage == 'project_close.php' || $currentPage == 'crud_close.php') ? "active" : ""; ?>">
        <a class="nav-link" href="project_close.php">
            <i class="fa-solid fa-notes fs-5"></i>
            <span class="fs-6">บันทึกปิดโครงการ</span>
        </a>
    </li>


    <!-- Nav Item - Utilities Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li> -->



    <!-- Sidebar Toggler (Sidebar) -->
    <!-- <div class="text-center d-none d-md-inline my-auto">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> -->

</ul>
<!-- End of Sidebar -->