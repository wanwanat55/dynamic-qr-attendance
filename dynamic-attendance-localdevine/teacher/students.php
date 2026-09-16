<?php
require_once '../config.php'; require_teacher();
$students=read_json('students.json');
$msg='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $action=$_POST['action']??'add';
    if($action==='add'){
        $id=trim($_POST['student_id']??'');
        if($id!==''){
            $students[]=['student_id'=>$id,'password'=>trim($_POST['password']??'1234'),'name'=>trim($_POST['name']??''),'class_name'=>trim($_POST['class_name']??'')];
            write_json('students.json',$students); $msg='เพิ่มนักเรียนแล้ว';
        }
    } elseif($action==='delete'){
        $id=$_POST['student_id']??'';
        $students=array_values(array_filter($students,fn($s)=>$s['student_id']!==$id));
        write_json('students.json',$students); $msg='ลบนักเรียนแล้ว';
    }
}
?>
<!doctype html><html lang="th"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>นักเรียน</title><link rel="stylesheet" href="../assets/css/style.css"></head><body>
<div class="wrap"><aside class="sidebar"><div class="brand">⚡ DQA Teacher</div><nav class="nav"><a href="dashboard.php">Dashboard</a><a href="qr.php">สร้าง QR Code</a><a class="active" href="students.php">จัดการนักเรียน</a><a href="attendance.php">ประวัติเช็กชื่อ</a><a href="logout.php">ออกจากระบบ</a></nav></aside>
<main class="main"><h1>จัดการนักเรียน</h1><?php if($msg):?><div class="alert ok"><?=$msg?></div><?php endif;?>
<div class="panel"><h2>เพิ่มนักเรียน</h2><form method="post" class="form"><input type="hidden" name="action" value="add"><label>รหัสนักเรียน</label><input name="student_id" required><label>ชื่อ-นามสกุล</label><input name="name" required><label>ชั้นเรียน</label><input name="class_name" value="ปวช.1/1"><label>รหัสผ่าน</label><input name="password" value="1234"><br><br><button class="btn">เพิ่มนักเรียน</button></form></div>
<div class="panel"><h2>รายชื่อนักเรียน</h2><input id="search" placeholder="ค้นหารหัส / ชื่อ / ห้อง..." oninput="filterRows()"><table><thead><tr><th>รหัส</th><th>ชื่อ</th><th>ห้อง</th><th>จัดการ</th></tr></thead><tbody id="rows">
<?php foreach($students as $s): ?><tr><td><?=htmlspecialchars($s['student_id'])?></td><td><?=htmlspecialchars($s['name'])?></td><td><?=htmlspecialchars($s['class_name'])?></td><td><form method="post" onsubmit="return confirm('ยืนยันการลบ?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="student_id" value="<?=htmlspecialchars($s['student_id'])?>"><button class="btn danger">ลบ</button></form></td></tr><?php endforeach;?>
</tbody></table></div></main></div>
<script>function filterRows(){let q=document.getElementById('search').value.toLowerCase();document.querySelectorAll('#rows tr').forEach(r=>r.style.display=r.innerText.toLowerCase().includes(q)?'':'none')}</script></body></html>