<?php
// Initialize cURL session
$ch = curl_init();

// Set the URL
$url = "https://super.footcric.xyz/Toffeelive/kaya_app.php?route=getIPTVList";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Execute the cURL session
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
} else {
    // Append Referer to m3u8 URLs
    $modified_response = preg_replace_callback(
        '/https?:\/\/[^\s"\']+\.m3u8/',
        function ($matches) {
            return $matches[0] . '|Referer=https://super.footcric.xyz/';
        },
        $response
    );

    // Print the modified response
    echo $modified_response;
}

curl_close($ch);
?>
