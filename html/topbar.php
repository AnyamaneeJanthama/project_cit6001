<?php
// Assuming $currentPage holds the name of the current page
$currentPage = basename($_SERVER['PHP_SELF']);

?>

<nav class="navbar navbar-light bg-white topbar mb-4 static-top shadow">

    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link text-gray-500" href="logout.php">
                <span class="fs-6 mr-2">ออกจากระบบ</span>
                <i class="fas fa-sign-out-alt fs-5 "></i>
            </a>

        </li>

    </ul>
</nav>