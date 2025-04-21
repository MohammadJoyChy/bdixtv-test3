<?php

// Target URL
$url = "https://tv.onlinetvbd.com/fancode/playlist/playlist.m3u";

// Custom channel line
$customLine = <<<EOD
#EXTINF:-1 tvg-logo="https://i.ibb.co.com/5gVjqSh0/Red-Abstract-Live-Stream-Free-Logo-20250309-192127-0002.png" group-title="𝗝𝗢𝗜𝗡 𝗢𝗨𝗥 𝗧𝗘𝗟𝗘𝗚𝗥𝗔𝗠", @bdixtv_official
https://bdixtv.short.gy/bdixtv_official.m3u8

EOD;

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Execute
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    // Check if custom line already exists
    if (strpos($response, '@bdixtv_official') === false) {
        // Add custom line at the end
        $response .= "\n" . $customLine;
    }

    // Output final playlist
    header("Content-Type: audio/x-mpegurl"); // M3U file type
    echo $response;
}

curl_close($ch);
?>
