// https://github.com/semihkagan/PhpVisitorSaver
// Lütfen yorum satırlarını silmeyin :/ ❤️
<?php
// Kullanıcının IP adresini al
function getUserIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // IP adresi proxy sunucusu tarafından gönderilmişse
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // IP adresi yük dengeleyici tarafından gönderilmişse
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        // Doğrudan erişim varsa
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Kullanıcının IP adresini al
$user_ip = getUserIpAddr();

// Zaman damgası ile birlikte IP adresini kaydet
$log_entry = date('Y-m-d H:i:s') . " - " . $user_ip . PHP_EOL;

// visitors.log dosyasına kaydet
file_put_contents('visitors.log', $log_entry, FILE_APPEND);

 echo "IP adresi kaydedildi.";
?>
// https://github.com/semihkagan tarafından yazılmıştır.
