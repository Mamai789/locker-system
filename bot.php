<?php

$update = json_decode(file_get_contents("php://input"), true);

if (!$update) {
    exit;
}

$message = $update["message"]["text"];
$chat_id = $update["message"]["chat"]["id"];

$botToken = "8889836191:AAFjJ_aJ0-8qCifnOQakzdtL5SKhdTpWYUs";

if ($message == "/start") {

    $reply = "Welcome to Smart Parcel Lockbox System!";

    file_get_contents(
        "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chat_id&text=" . urlencode($reply)
    );
}

?>