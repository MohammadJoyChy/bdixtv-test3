<?php
// Fetch JSON from the URL using cURL
$url = "https://raw.githubusercontent.com/drmlive/willow-live-events/refs/heads/main/willow.json";

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return output as a string
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects

// Execute cURL request
$response = curl_exec($ch);

// Check for any cURL error
if(curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    // Decode the JSON response
    $data = json_decode($response, true);

    // Add #EXTM3U line at the top
    echo "#EXTM3U\n";

    // Add the #EXTINF tag for the general stream link (always on top)
    echo "#EXTINF:-1 tvg-logo=\"https://i.ibb.co.com/5gVjqSh0/Red-Abstract-Live-Stream-Free-Logo-20250309-192127-0002.png\" group-title=\"𝗝𝗢𝗜𝗡 𝗢𝗨𝗥 𝗧𝗘𝗟𝗘𝗚𝗥𝗔𝗠\", @bdixtv_official\n";
    echo "https://bdixtv.short.gy/bdixtv_official\n";
    
    // Loop through each match
    foreach ($data['matches'] as $match) {
        // Get the first stream URL
        $stream_url = $match['playback_data']['urls'][0]['url'];

        // Get the license key for the stream
        $license_key = $match['playback_data']['keys'][0] ?? '';

        // Print the #EXTINF tag with match details
        echo "#EXTINF:-1 tvg-id=\"" . $match['titleId'] . "\" tvg-logo=\"" . $match['cover'] . "\" group-title=\"Live Matches\", " . $match['title'] . "\n";

        // Add #KODIPROP and #EXTVLCOPT tags for each stream
        echo "#KODIPROP:inputstream.adaptive.license_type=clearkey\n";
        echo "#KODIPROP:inputstream.adaptive.license_key=" . $license_key . "\n";
        echo "#EXTVLCOPT:http-origin=" . $stream_url . "\n";

        // Print the stream URL
        echo $stream_url . "\n";
        echo "\n";
    }
}

// Close the cURL session
curl_close($ch);
?>
