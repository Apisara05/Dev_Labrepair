<?php
// register.php
require 'db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = 'กรุณากรอกชื่อผู้ใช้และรหัสผ่าน';
    } else {
        // Check if username already exists
        $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $error = 'ชื่อผู้ใช้นี้มีคนใช้แล้ว';
        } else {
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_ARGON2ID);

            // Insert new user into the database
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$username, $hashed_password])) {
                $success = 'สมัครสมาชิกสำเร็จ! คุณสามารถ <a href="login.php">เข้าสู่ระบบ</a> ได้เลย';
            } else {
                $error = 'เกิดข้อผิดพลาดในการสมัครสมาชิก';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="content-wrapper">
                    <h1 class="title mb-4">สมัครสมาชิก DevClub</h1>

                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <?php if ($success): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>

                    <?php if (!$success): ?>
                    <form action="register.php" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">ชื่อผู้ใช้ (Username)</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">รหัสผ่าน</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">สมัครสมาชิก</button>
                    </form>
                    <?php endif; ?>
                    <div class="text-center mt-3">
                        <a href="login.php">กลับไปหน้าเข้าสู่ระบบ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
