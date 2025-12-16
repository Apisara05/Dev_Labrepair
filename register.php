<?php
require 'db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!$username || !$email || !$password) {
        $error = 'กรุณากรอกข้อมูลให้ครบ';
    } else {

        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $error = 'อีเมลนี้ถูกใช้งานแล้ว';
        } else {

            $hashed = password_hash($password, PASSWORD_ARGON2ID);

            $stmt = $pdo->prepare(
                "INSERT INTO users (username, email, password)
                 VALUES (?, ?, ?)"
            );

            $stmt->execute([$username, $email, $hashed]);

            $success = 'สมัครสมาชิกสำเร็จ';
        }
    }
}
