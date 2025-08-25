<?php
if (!function_exists('formatDate')) {
    function formatDate($dateString) {
        $date = new DateTime($dateString);
        return $date->format('d F Y'); // 01 June 2025
    }
}

if (!function_exists('formatTime')) {
    function formatTime($timeString) {
        $time = new DateTime($timeString);
        return $time->format('h:i:s A'); // 10:30:00 AM
    }
}

if (!function_exists('formatDateTime')) {
    function formatDateTime($dateTimeString) {
        $dt = new DateTime($dateTimeString);
        return $dt->format('d F Y h:i:s A'); // 01 June 2025 10:30:00 AM
    }
}
