<?php
require_once '../config.php'; require_student();
$att=array_reverse(read_json('attendance.json')); $mine=array_filter($att,fn($a)=>$a['student_id']===$_SESSION['student']['student_id']);
?>
<!doctype html><html lang="th"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>ประวัติของฉัน</title><link rel="stylesheet" href="../assets/css/style.css"></head><body>
<div class="wrap"><aside class="sidebar"><div class="brand">🎓 DQA Student</div><nav class="nav"><a href="dashboard.php">Dashboard</a><a href="manual.php">กรอก Token</a><a class="active" href="history.php">ประวัติของฉัน</a><a href="logout.php">ออกจากระบบ</a></nav></aside>
<main class="main"><h1>ประวัติการเข้าเรียน</h1><div class="panel"><table><thead><tr><th>คิวเวลา</th><th>เช็กชื่อเมื่อ</th><th>สถานะ</th></tr></thead><tbody><?php foreach($mine as $a):?><tr><td><?=htmlspecialchars($a['slot_time'])?></td><td><?=htmlspecialchars($a['checked_at'])?></td><td><span class="badge"><?=htmlspecialchars($a['status'])?></span></td></tr><?php endforeach;?></tbody></table></div></main></div></body></html>