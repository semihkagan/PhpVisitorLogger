<?php
// https://github.com/semihkagan/PhpVisitorSaver
// Lütfen yorum satırlarını silmeyin :/ ❤️

function getUserIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
$user_ip = getUserIpAddr();

$last_log = @file('visitors.log');
$last_num = 0;
if ($last_log) {
    $last_line = trim(end($last_log));
    if (preg_match('/^\[(\d+)\]/', $last_line, $matches)) {
        $last_num = (int)$matches[1];
    }
}

$new_num = $last_num + 1;
$log_entry = "[$new_num] - " . $user_ip . " [" . date('Y-m-d H:i:s') . "]" . PHP_EOL;
file_put_contents('visitors.log', $log_entry, FILE_APPEND);
echo "IP adresi kaydedildi.";

// https://github.com/semihkagan tarafından yazılmıştır.
?>
