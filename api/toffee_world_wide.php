<?php 
// Set Content-Type header
header('Content-Type: audio/x-mpegurl');

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
    echo "#EXTM3U\n"; // fallback m3u header
    echo "# Error fetching playlist: " . curl_error($ch);
} else {
    // Append Referer to m3u8 URLs
    $modified_response = preg_replace_callback(
        '/https?:\/\/[^\s"\']+\.m3u8/',
        function ($matches) {
            return $matches[0] . '|Referer=https://super.footcric.xyz/';
        },
        $response
    );

    // Prepend the fixed M3U8 entry at the top
    $fixed_entry = <<<EOD
#EXTM3U
#EXTINF:-1 tvg-logo="https://i.ibb.co.com/5gVjqSh0/Red-Abstract-Live-Stream-Free-Logo-20250309-192127-0002.png" group-title="𝗝𝗢𝗜𝗡 𝗢𝗨𝗥 𝗧𝗘𝗟𝗘𝗚𝗥𝗔𝗠", @bdixtv_official
https://bdixtv.short.gy/bdixtv_official.m3u8
EOD;

    // Combine fixed entry + modified response
    echo $fixed_entry . "\n" . $modified_response;
}

curl_close($ch);
?>
