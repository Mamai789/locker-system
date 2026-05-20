<?php

$response = file_get_contents("https://api.telegram.org");

if ($response === FALSE) {
    echo "FAILED: Cannot reach Telegram API";
} else {
    echo "SUCCESS: Telegram API is reachable";
}

?>