<?php
$url = "https://tv.onlinetvbd.com/fancode/playlist/playlist.m3u";

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects

// Execute cURL request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    // Print the page source
    echo htmlspecialchars($response); // Optional: htmlspecialchars to escape HTML tags
}

// Close cURL session
curl_close($ch);
?>
