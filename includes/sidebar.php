<?php
$current = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar">
    <h5 class="text-center py-3 border-bottom">
        DevClub Admin
    </h5>

    <a href="index.php" class="<?= $current == 'index.php' ? 'active' : '' ?>">
        Dashboard
    </a>

    <a href="add.php" class="<?= $current == 'add.php' ? 'active' : '' ?>">
        เพิ่มสมาชิก
    </a>

    <a href="logout.php">
        Logout
    </a>
</div>