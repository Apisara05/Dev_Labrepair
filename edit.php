<?php
require "config/db.php";
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM members WHERE id = ?");
$stmt->execute([$id]);
$member = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sql = "UPDATE members 
            SET fullname=?, email=?, major=?, study_year=?
            WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['fullname'],
        $_POST['email'],
        $_POST['major'],
        $_POST['study_year'],
        $id
    ]);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>แก้ไขสมาชิก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-4">

        <h4 class="text-primary">แก้ไขข้อมูลสมาชิก</h4>

        <form method="post" class="bg-white p-4 rounded shadow-sm">
            <input class="form-control mb-3" name="fullname" value="<?= $member['fullname'] ?>" required>
            <input class="form-control mb-3" name="email" value="<?= $member['email'] ?>" required>
            <input class="form-control mb-3" name="major" value="<?= $member['major'] ?>" required>
            <input class="form-control mb-3" name="study_year" value="<?= $member['study_year'] ?>" required>

            <button class="btn btn-warning">อัปเดต</button>
            <a href="index.php" class="btn btn-secondary">กลับ</a>
        </form>

    </div>
</body>

</html>