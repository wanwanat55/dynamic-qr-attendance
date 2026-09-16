<?php
require_once '../config.php';
$att=read_json('attendance.json');
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=attendance_'.date('Ymd').'.csv');
$out=fopen('php://output','w');
fwrite($out, "\xEF\xBB\xBF");
fputcsv($out,['รหัสนักเรียน','ชื่อ','ชั้นเรียน','คิวเวลา','เช็กชื่อเมื่อ','สถานะ']);
foreach($att as $a) fputcsv($out,[$a['student_id'],$a['student_name'],$a['class_name'],$a['slot_time'],$a['checked_at'],$a['status']]);
fclose($out);
?>