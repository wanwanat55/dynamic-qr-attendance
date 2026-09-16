<?php
require_once '../config.php'; require_teacher();
$slot=current_slot_time();
?>
<!doctype html><html lang="th"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Dynamic QR</title><link rel="stylesheet" href="../assets/css/style.css"></head><body>
<div class="wrap"><aside class="sidebar"><div class="brand">⚡ DQA Teacher</div><nav class="nav"><a href="dashboard.php">Dashboard</a><a class="active" href="qr.php">สร้าง QR Code</a><a href="students.php">จัดการนักเรียน</a><a href="attendance.php">ประวัติเช็กชื่อ</a><a href="logout.php">ออกจากระบบ</a></nav></aside>
<main class="main"><div class="top"><div><h1>Dynamic QR Code</h1><p class="muted">คิวปัจจุบัน <b id="slot"><?=date('H:i',strtotime($slot))?></b> น.</p></div><span class="badge">เปลี่ยนทุก 15 วินาที</span></div>
<div class="panel qrbox"><img id="qr" class="qrimg" alt="QR Code"><div class="countdown" id="count">15</div><div class="progress"><div id="bar"></div></div><p class="muted">ให้นักเรียนสแกน QR นี้เพื่อเช็กชื่อ</p><div class="alert">Token: <code id="token">กำลังโหลด...</code></div></div>
</main></div>
<script>
async function updateQR(){
 const r=await fetch('../api/qr_data.php?x='+Date.now()); const d=await r.json();
 document.getElementById('token').textContent=d.token;
 document.getElementById('slot').textContent=d.slot;
 const target=location.origin + location.pathname.replace('/teacher/qr.php','/student/check.php') + '?token='+encodeURIComponent(d.token);
 document.getElementById('qr').src='https://api.qrserver.com/v1/create-qr-code/?size=320x320&data='+encodeURIComponent(target);
}
function tick(){
 const remain=15-(Math.floor(Date.now()/1000)%15);
 document.getElementById('count').textContent=remain;
 document.getElementById('bar').style.width=(remain/15*100)+'%';
 if(remain===15) updateQR();
}
updateQR();tick();setInterval(tick,1000);
</script></body></html>