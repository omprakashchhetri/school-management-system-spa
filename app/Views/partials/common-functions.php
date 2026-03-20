<?php

    function formatDate($dateString) {
        // Convert the string into a DateTime object
        $date = new DateTime($dateString);
        
        // Format: d F Y → 01 June 2025
        return $date->format('d F Y');
    }

    $test = "test";
?>