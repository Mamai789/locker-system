<?php
function sendTelegram($chat_id, $message) {
    $botToken = "8889836191:AAFjJ_aJ0-8qCifnOQakzdtL5SKhdTpWYUs";

    $url = "https://api.telegram.org/bot$8889836191:AAFjJ_aJ0-8qCifnOQakzdtL5SKhdTpWYUs/sendMessage";

    $data = [
        "chat_id" => $chat_id,
        "text" => $message,
        "parse_mode" => "HTML"
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

     $response = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log("Telegram Error: " . curl_error($ch));
    }

    curl_close($ch);

    return $response;
}
?>