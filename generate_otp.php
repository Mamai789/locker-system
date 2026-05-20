<?php
include "send_telegram.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli(
    "sql302.infinityfree.com",
    "if0_41951199",
    "12345Ibws",
    "if0_41951199_parcel_lockbox"
);

// 1. Get parcel_id from ESP32 / request
$parcel_id = intval($_GET['parcel_id'] ?? $_POST['parcel_id'] ?? 0);

// 2. Generate OTP
$otp = random_int(100000, 999999);
$expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

// 3. Find user linked to parcel
$sql = "SELECT users.chat_id 
        FROM parcels 
        JOIN users ON parcels.user_id = users.UserID
        WHERE parcels.parcel_id = '$parcel_id'";

$result = $conn->query($sql);

if ($row = $result->fetch_assoc()) {

    $chat_id = $row['chat_id'];

    // 4. Save OTP
    $conn->query("UPDATE parcels 
                  SET otp='$otp', otp_expiry='$expiry' 
                  WHERE parcel_id='$parcel_id'");

    // 5. Send Telegram message
    sendTelegram($chat_id, "Your OTP is: $otp (valid 5 minutes)");

    echo json_encode([
        "status" => "success",
        "otp" => $otp
    ]);

} else {
    echo json_encode([
        "status" => "error",
        "message" => "Parcel not found"
    ]);
}
?>