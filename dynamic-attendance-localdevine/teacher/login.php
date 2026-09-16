<?php
session_start();
require_once '../config.php';
$error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $teachers=read_json('teachers.json');
    foreach($teachers as $t){
        if($t['username']===($_POST['username']??'') && $t['password']===($_POST['password']??'')){
            $_SESSION['teacher']=$t;
            header('Location: dashboard.php'); exit;
        }
    }
    $error='ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
}
?>
<!doctype html><html lang="th"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>ครูเข้าสู่ระบบ</title><link rel="stylesheet" href="../assets/css/style.css"></head>
<body class="login-page"><div class="login-card"><h1>👨‍🏫 เข้าสู่ระบบครู</h1><p class="muted">บัญชีทดลอง: teacher / 1234</p>
<?php if($error): ?><div class="alert error"><?=htmlspecialchars($error)?></div><?php endif; ?>
<form method="post"><label>ชื่อผู้ใช้</label><input name="username" required><label>รหัสผ่าน</label><input type="password" name="password" required><br><br><button class="btn">เข้าสู่ระบบ</button> <a class="btn secondary" href="../index.php">กลับ</a></form></div></body></html>