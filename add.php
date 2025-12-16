<?php
require "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error = "รูปแบบอีเมลไม่ถูกต้อง";
    } else {
        $sql = "INSERT INTO members (fullname, email, major, study_year)
                VALUES (:fullname, :email, :major, :year)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':fullname' => $_POST['fullname'],
            ':email' => $_POST['email'],
            ':major' => $_POST['major'],
            ':year' => $_POST['study_year']
        ]);
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>เพิ่มสมาชิก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-4">
        <h4 class="text-primary">เพิ่มสมาชิกใหม่</h4>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif ?>

        <form method="post" class="bg-white p-4 rounded shadow-sm">
            <input class="form-control mb-3" name="fullname" placeholder="ชื่อ-นามสกุล" required>
            <input class="form-control mb-3" name="email" placeholder="อีเมล" required>
            <input class="form-control mb-3" name="major" placeholder="สาขาที่ศึกษา" required>
            <input class="form-control mb-3" name="study_year" placeholder="ปีการศึกษา (พ.ศ.)" required>

            <button class="btn btn-primary">บันทึก</button>
            <a href="index.php" class="btn btn-secondary">กลับ</a>
        </form>
    </div>
</body>

</html>