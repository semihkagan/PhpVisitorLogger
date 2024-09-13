<?php
// https://github.com/semihkagan/PhpVisitorSaver
// Lütfen yorum satırlarını silmeyin :/ ❤️

// Settings
$log_enabled = true; 
$total_visitors_enabled = true; 
// JSON Files
$json_file = 'total_visitors.json';
$visitor_list_file = 'visitor_list.json';

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
$total_visits = 0;
$visitor_list = [];

if ($total_visitors_enabled) {
    if (file_exists($json_file)) {
        $json_data = file_get_contents($json_file);
        $data = json_decode($json_data, true);
        if (isset($data['total_visitors'])) {
            $total_visits = (int)$data['total_visitors'];
        }
    }

    if (file_exists($visitor_list_file)) {
        $visitor_list_data = file_get_contents($visitor_list_file);
        $visitor_list = json_decode($visitor_list_data, true);
        if (!is_array($visitor_list)) {
            $visitor_list = [];
        }
    }

    if (!in_array($user_ip, $visitor_list)) {
        $total_visits++;
        $visitor_list[] = $user_ip;
        file_put_contents($visitor_list_file, json_encode($visitor_list, JSON_PRETTY_PRINT));
        file_put_contents($json_file, json_encode(['total_visitors' => $total_visits], JSON_PRETTY_PRINT));
    }
}

if ($log_enabled) {
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
}

echo "IP adresi kontrol edildi ve kaydedildi.";

// https://github.com/semihkagan tarafından yazılmıştır.
?>
