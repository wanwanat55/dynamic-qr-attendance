<?php
require_once '../config.php'; require_teacher();
$students=read_json('students.json'); $att=read_json('attendance.json');
$today=date('Y-m-d'); $todayAtt=array_filter($att,fn($a)=>str_starts_with($a['checked_at'],$today));
$present=count($todayAtt); $total=count($students);
?>
<!doctype html><html lang="th"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Dashboard ครู</title><link rel="stylesheet" href="../assets/css/style.css"></head><body>
<div class="wrap"><aside class="sidebar"><div class="brand">⚡ DQA Teacher</div><nav class="nav"><a class="active" href="dashboard.php">Dashboard</a><a href="qr.php">สร้าง QR Code</a><a href="students.php">จัดการนักเรียน</a><a href="attendance.php">ประวัติเช็กชื่อ</a><a href="logout.php">ออกจากระบบ</a></nav></aside>
<main class="main"><div class="top"><div><h1>สวัสดี <?=htmlspecialchars($_SESSION['teacher']['name'])?></h1><div class="muted"><?=date('d/m/Y H:i:s')?> น.</div></div><span class="badge"><span class="status-dot"></span> ระบบพร้อมใช้งาน</span></div>
<div class="cards"><div class="card"><div class="muted">นักเรียนทั้งหมด</div><div class="num"><?=$total?></div></div><div class="card"><div class="muted">เช็กชื่อวันนี้</div><div class="num"><?=$present?></div></div><div class="card"><div class="muted">ยังไม่เช็ก</div><div class="num"><?=max(0,$total-$present)?></div></div><div class="card"><div class="muted">คิวปัจจุบัน</div><div class="num"><?=date('H:i',strtotime(current_slot_time()))?></div></div></div>
<div class="panel"><h2>ระบบ Dynamic QR Attendance</h2><p class="muted">QR เปลี่ยนทุก 15 วินาที โดยคิวแรกเริ่ม 07:00 และคิวถัดไปเลื่อนไปทีละ 5 นาที</p><a class="btn" href="qr.php">เปิดหน้า QR</a></div></main></div></body></html>