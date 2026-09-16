<?php
require_once '../config.php';
session_start();
$token=$_GET['token']??'';
if(empty($_SESSION['student'])){
  header('Location: login.php?next='.urlencode('check.php?token='.$token)); exit;
}
$msg=''; $ok=false;
if(!$token || !token_valid($token)){
  $msg='QR Code หมดอายุหรือไม่ถูกต้อง กรุณาสแกนใหม่';
} else {
  $s=$_SESSION['student']; $slot=current_slot_time(); $att=read_json('attendance.json');
  $exists=false;
  foreach($att as $a){
    if($a['student_id']===$s['student_id'] && $a['slot_time']===$slot){$exists=true;break;}
  }
  if($exists){$msg='คุณเช็กชื่อในคิวนี้แล้ว'; $ok=true;}
  else{
    $checked=date('Y-m-d H:i:s');
    $slotTs=strtotime($slot); $status=(time()-$slotTs>120)?'สาย':'มา';
    $att[]=['student_id'=>$s['student_id'],'student_name'=>$s['name'],'class_name'=>$s['class_name'],'slot_time'=>$slot,'checked_at'=>$checked,'status'=>$status];
    write_json('attendance.json',$att); $msg='เช็กชื่อสำเร็จ เวลา '.date('H:i:s').' น. สถานะ: '.$status; $ok=true;
  }
}
?>
<!doctype html><html lang="th"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>เช็กชื่อ</title><link rel="stylesheet" href="../assets/css/style.css"></head><body class="login-page"><div class="login-card" style="text-align:center"><div style="font-size:70px"><?=$ok?'✅':'❌'?></div><h1><?=$ok?'สำเร็จ':'ไม่สำเร็จ'?></h1><div class="alert <?=$ok?'ok':'error'?>"><?=htmlspecialchars($msg)?></div><a class="btn" href="dashboard.php">กลับ Dashboard</a></div></body></html>