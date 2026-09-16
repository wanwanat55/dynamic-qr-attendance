<?php
require_once '../config.php';
header('Content-Type: application/json; charset=utf-8');
echo json_encode([
  'token'=>token_for_now(),
  'slot'=>date('H:i',strtotime(current_slot_time())),
  'server_time'=>date('H:i:s')
], JSON_UNESCAPED_UNICODE);
?>