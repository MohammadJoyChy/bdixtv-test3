<?php
// Target URL
$url = "https://super.footcric.xyz/Toffeelive/kaya_app.php?route=getIPTVList";

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Optional, for HTTPS

// Set custom headers
$headers = [
    "Referer: https://super.footcric.xyz/Toffeelive/"
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Optional: User-Agent
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");

// Execute the request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
    exit;
}

// Close cURL
curl_close($ch);

// Now modify .m3u8 URLs by appending |Referer=...
$response = preg_replace_callback(
    '/https?:\/\/[^\s\'"]+\.m3u8/',
    function ($matches) {
        return $matches[0] . '|Referer=https://super.footcric.xyz/Toffeelive/';
    },
    $response
);

// Output the modified content
echo $response;
?>
