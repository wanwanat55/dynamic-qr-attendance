<?php
date_default_timezone_set('Asia/Bangkok');

define('DATA_DIR', __DIR__ . '/data');

function read_json($file, $default = []) {
    $path = DATA_DIR . '/' . $file;
    if (!file_exists($path)) return $default;
    $raw = file_get_contents($path);
    $data = json_decode($raw, true);
    return is_array($data) ? $data : $default;
}

function write_json($file, $data) {
    $path = DATA_DIR . '/' . $file;
    file_put_contents($path, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), LOCK_EX);
}

function current_slot_time() {
    $now = new DateTime();
    $start = new DateTime($now->format('Y-m-d') . ' 07:00:00');
    if ($now < $start) return $start->format('Y-m-d H:i:00');
    $diffMinutes = floor(($now->getTimestamp() - $start->getTimestamp()) / 60);
    $slotIndex = floor($diffMinutes / 5);
    $start->modify('+' . ($slotIndex * 5) . ' minutes');
    return $start->format('Y-m-d H:i:00');
}

function token_for_now() {
    $slice = floor(time() / 15);
    $slot = current_slot_time();
    return substr(hash('sha256', 'DQA|' . $slot . '|' . $slice . '|LOCALDEVINE'), 0, 16);
}

function token_valid($token) {
    $slot = current_slot_time();
    $slice = floor(time() / 15);
    for ($i=0; $i<=1; $i++) {
        $expected = substr(hash('sha256', 'DQA|' . $slot . '|' . ($slice-$i) . '|LOCALDEVINE'), 0, 16);
        if (hash_equals($expected, $token)) return true;
    }
    return false;
}

function require_teacher() {
    session_start();
    if (empty($_SESSION['teacher'])) {
        header('Location: login.php');
        exit;
    }
}

function require_student() {
    session_start();
    if (empty($_SESSION['student'])) {
        header('Location: login.php');
        exit;
    }
}
?>