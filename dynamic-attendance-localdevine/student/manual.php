<?php
require_once '../config.php'; require_student();
?>
<!doctype html><html lang="th"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>กรอก Token</title><link rel="stylesheet" href="../assets/css/style.css"></head><body>
<div class="wrap"><aside class="sidebar"><div class="brand">🎓 DQA Student</div><nav class="nav"><a href="dashboard.php">Dashboard</a><a class="active" href="manual.php">กรอก Token</a><a href="history.php">ประวัติของฉัน</a><a href="logout.php">ออกจากระบบ</a></nav></aside>
<main class="main"><h1>ทดสอบเช็กชื่อด้วย Token</h1><div class="panel form"><p class="muted">คัดลอก Token จากหน้าครูมาใส่ตรงนี้</p><form action="check.php" method="get"><label>Token</label><input name="token" required><br><br><button class="btn">เช็กชื่อ</button></form></div></main></div></body></html>