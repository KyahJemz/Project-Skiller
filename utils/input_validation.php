<?php

function sanitizeInput($input) {
    // Remove HTML tags
    $sanitizedInput = strip_tags($input);

    // Remove leading and trailing whitespaces
    $sanitizedInput = trim($sanitizedInput);

    // Convert special characters to HTML entities
    $sanitizedInput = htmlspecialchars($sanitizedInput, ENT_QUOTES, 'UTF-8');

    // Additional custom rules as needed...

    return $sanitizedInput;
}

?>