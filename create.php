<?php
// create.php
require 'auth_check.php';
require 'db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $major = trim($_POST['major']);
    $study_year = trim($_POST['study_year']);

    if (empty($fullname) || empty($email) || empty($major) || empty($study_year)) {
        $error = 'กรุณากรอกข้อมูลให้ครบทุกช่อง';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'รูปแบบอีเมลไม่ถูกต้อง';
    } else {
        try {
            $sql = "INSERT INTO members (fullname, email, major, study_year) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$fullname, $email, $major, $study_year]);
            
            // Redirect to index page after successful insertion
            header("Location: index.php");
            exit();

        } catch (PDOException $e) {
            $error = "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มสมาชิกใหม่</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="content-wrapper">
            <h1 class="title mb-4">เพิ่มสมาชิกใหม่</h1>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form action="create.php" method="post">
                <div class="mb-3">
                    <label for="fullname" class="form-label">ชื่อ-นามสกุล</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">อีเมล</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="major" class="form-label">สาขาที่ศึกษา</label>
                    <input type="text" class="form-control" id="major" name="major" required>
                </div>
                <div class="mb-3">
                    <label for="study_year" class="form-label">ปีการศึกษา (พ.ศ.)</label>
                    <input type="number" class="form-control" id="study_year" name="study_year" placeholder="เช่น 2567" required>
                </div>
                <button type="submit" class="btn btn-primary">บันทึก</button>
                <a href="index.php" class="btn btn-secondary">ยกเลิก</a>
            </form>
        </div>
    </div>
</body>
</html>
