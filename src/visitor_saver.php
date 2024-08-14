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
$log_entry = date('Y-m-d H:i:s') . " - " . $user_ip . PHP_EOL;
file_put_contents('visitors.log', $log_entry, FILE_APPEND);

echo "IP adresi kaydedildi.";

// https://github.com/semihkagan tarafından yazılmıştır.
?>
