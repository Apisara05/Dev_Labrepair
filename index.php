<?php
require __DIR__ . "/config/db.php";
$stmt = $conn->query("SELECT * FROM members ORDER BY id DESC");
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);
require "db.php";
session_start();
require "includes/navbar.php";

?>



<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>DevClub Members</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
</head>

<body class="bg-light">
    <div class="container mt-4">

        <h3 class="text-primary mb-3">รายชื่อสมาชิก DevClub</h3>

        <a href="add.php" class="btn btn-primary mb-3">+ เพิ่มสมาชิกใหม่</a>

        <div class="table-responsive">
            <table class="table table-bordered bg-white">
                <thead class="table-primary">
                    <tr>
                        <th>รหัส</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>Email</th>
                        <th>สาขา</th>
                        <th>ปีการศึกษา</th>
                        <th>จัดการ</th>
                        <th>วันที่เพิ่ม</th>
                        <th>วันที่แก้ไขล่าสุด</th>
                        <th>สถานะ</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($members as $m): ?>
                        <tr>
                            <td><?= $m['id'] ?></td>
                            <td><?= $m['fullname'] ?></td>
                            <td><?= $m['email'] ?></td>
                            <td><?= $m['major'] ?></td>
                            <td><?= $m['study_year'] ?></td>
                            <td>
                                <a href="edit.php?id=<?= $m['id'] ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                                <a href="delete.php?id=<?= $m['id'] ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('ยืนยันการลบ?')">ลบ</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>