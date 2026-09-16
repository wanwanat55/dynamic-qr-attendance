<?php
session_start(); require_once '../config.php'; $error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $students=read_json('students.json');
  foreach($students as $s){
    if($s['student_id']===($_POST['student_id']??'') && $s['password']===($_POST['password']??'')){
      $_SESSION['student']=$s;
      $go=$_GET['next']??'dashboard.php';
      header('Location: '.$go); exit;
    }
  } $error='รหัสนักเรียนหรือรหัสผ่านไม่ถูกต้อง';
}
?>
<!doctype html><html lang="th"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>นักเรียนเข้าสู่ระบบ</title><link rel="stylesheet" href="../assets/css/style.css"></head><body class="login-page"><div class="login-card"><h1>🎓 เข้าสู่ระบบนักเรียน</h1><p class="muted">บัญชีทดลอง: 65001 / 1234</p><?php if($error):?><div class="alert error"><?=$error?></div><?php endif;?><form method="post"><label>รหัสนักเรียน</label><input name="student_id" required><label>รหัสผ่าน</label><input type="password" name="password" required><br><br><button class="btn">เข้าสู่ระบบ</button> <a class="btn secondary" href="../index.php">กลับ</a></form></div></body></html>