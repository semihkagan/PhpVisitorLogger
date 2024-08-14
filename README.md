# PHP Visitor Saver - Log User IP Addresses 📋

This PHP script logs the IP addresses of visitors to your website, along with a timestamp. It appends each entry to a `visitors.log` file for tracking purposes. 

## Features ✨

- **Capture IP Address**: Retrieves the IP address of the visitor.
- **Log Timestamp**: Records the date and time of the visit.
- **Append to Log File**: Saves the log entry to a file named `visitors.log`.

## Usage 🚀

### 1. Upload the Script 📤

Upload the `visitor_saver.php` file to your web server.

### 2. Access the Script 🌐

Access the script through your web browser or a server-side request. This will trigger the script to log the IP address of the visitor.

### 3. Check the Log File 📄

The IP addresses and timestamps will be appended to `visitors.log` file located in the same directory as the script.

### Example

To test the script, navigate to the URL where `visitor_saver.php` is hosted. You should see the message "IP address recorded" and the IP address will be logged in `visitors.log`.

## Code Explanation 🧑‍💻

```php
<?php
// https://github.com/semihkagan/PhpVisitorSaver
// Lütfen yorum satırlarını silmeyin :/ ❤️

// Kullanıcının IP adresini al
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

// Kullanıcının IP adresini al
$user_ip = getUserIpAddr();

// Zaman damgası ile birlikte IP adresini kaydet
$log_entry = date('Y-m-d H:i:s') . " - " . $user_ip . PHP_EOL;

// visitors.log dosyasına kaydet
file_put_contents('visitors.log', $log_entry, FILE_APPEND);

echo "IP adresi kaydedildi.";

// https://github.com/semihkagan tarafından yazılmıştır.
?>
```
