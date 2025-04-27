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
    // Define the entry to add at the top
    $new_entry = '#EXTINF:-1 tvg-logo="https://i.ibb.co.com/5gVjqSh0/Red-Abstract-Live-Stream-Free-Logo-20250309-192127-0002.png" group-title="𝗝𝗢𝗜𝗡 𝗢𝗨𝗥 𝗧𝗘𝗟𝗘𝗚𝗥𝗔𝗠", @bdixtv_official
https://bdixtv.short.gy/bdixtv_official.m3u8' . PHP_EOL;

    // Append Referer to m3u8 URLs
    $modified_response = preg_replace_callback(
        '/https?:\/\/[^\s"\']+\.m3u8/',
        function ($matches) {
            return $matches[0] . '|Referer=https://super.footcric.xyz/';
        },
        $response
    );

    // Prepend the new entry to the modified response
    $final_response = $new_entry . $modified_response;

    // Set the correct headers for m3u playlist
    header('Content-Type: audio/x-mpegurl');
    header('Content-Disposition: inline; filename="playlist.m3u"');

    // Output the response as a .m3u playlist
    echo $final_response;
}

curl_close($ch);
?>
