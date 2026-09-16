<?php
session_start();
?>
<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Dynamic QR Attendance</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="landing">
<div class="hero-card">
  <div class="logo">QR</div>
  <h1>Dynamic QR Attendance</h1>
  <p>ระบบเช็กชื่อเข้าเรียนด้วย QR Code แบบเปลี่ยนทุก 15 วินาที</p>
  <div class="choice-grid">
    <a class="choice teacher" href="teacher/login.php">
      <span class="big-icon">👨‍🏫</span>
      <h2>สำหรับครู</h2>
      <p>สร้าง QR • ดูรายชื่อ • สรุปการเข้าเรียน</p>
    </a>
    <a class="choice student" href="student/login.php">
      <span class="big-icon">🎓</span>
      <h2>สำหรับนักเรียน</h2>
      <p>เช็กชื่อ • ดูสถานะ • ดูประวัติ</p>
    </a>
  </div>
  <small>คิวแรก 07:00 น. และคิวต่อไปเพิ่มทีละ 5 นาที</small>
</div>
</body>
</html>
