<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand fw-bold" href="index.php">
            DevClub Admin
        </a>

        <!-- Toggle (Mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'index.php' ? 'active' : '' ?>"
                        href="index.php">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'add.php' ? 'active' : '' ?>"
                        href="add.php">
                        เพิ่มสมาชิก
                    </a>
                </li>

            </ul>

            <!-- User Info -->
            <span class="navbar-text me-3">
                👤 <?= htmlspecialchars($_SESSION['username']) ?>
            </span>

            <!-- Logout -->
            <a href="logout.php" class="btn btn-outline-light btn-sm">
                Logout
            </a>
        </div>
    </div>
</nav>