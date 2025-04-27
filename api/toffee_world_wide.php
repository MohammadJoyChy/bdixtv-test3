<?php
// Initialize cURL session
$ch = curl_init();

// Set the URL to fetch
curl_setopt($ch, CURLOPT_URL, "https://super.footcric.xyz/Toffeelive/kaya_app.php?route=getIPTVList");

// Return the transfer as a string instead of outputting it directly
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Execute the cURL session and store the result in a variable
$response = curl_exec($ch);

// Check if any error occurred
if ($response === false) {
    echo "cURL Error: " . curl_error($ch);
} else {
    // Print the page source (the response from the URL)
    echo $response;
}

// Close the cURL session
curl_close($ch);
?>
