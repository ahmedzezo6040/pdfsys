<?php
function sanitizeInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

function validateFile($file)
{
    $allowed_types = ['application/pdf'];
    return in_array($file['type'], $allowed_types);
}
