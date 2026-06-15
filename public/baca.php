<?php
$env_path = realpath(__DIR__ . '/../.env');

if ($env_path && file_exists($env_path)) {
    header("Content-Type: text/plain");
    echo file_get_contents($env_path);
} else {
    http_response_code(404);
    echo "File ../.env tidak ditemukan.";
}
?>