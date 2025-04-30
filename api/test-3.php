<?php

// The target URL
$url = "https://host.mafiatv.live/toffee/kaya_app.php?route=getIPTVList";

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return response as a string
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects if any
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL cert verification (optional, not recommended for production)

// Execute cURL session and store the response
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    // Print the response (page source)
    echo $response;
}

// Close cURL session
curl_close($ch);

?>
