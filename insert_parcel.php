<?php
include "db.php";

$postman_pin = $_POST['postman_pin'];
$locker_id = $_POST['locker_id'];
$phone_no = $_POST['phone_no'];

$correct_pin = "1234";

if($postman_pin != $correct_pin){
    die("Invalid Postman PIN");
}

// Find user
$userQuery = "SELECT * FROM users
                WHERE phone_no = '$phone_no'";

$userResult = $conn->query($userQuery);

if($userResult->num_rows == 0){
    die("User not registered");
}

$user = $userResult->fetch_assoc();

$user_id = $user['user_id'];

// Generate OTP
$otp = rand(100000,999999);

VALUES
('$user_id','$locker_id','stored','$otp');

if($conn->query($sql)){
    
    // Update locker status
    $update = "UPDATE lockers 
                SET status='occupied'
                WHERE locker_id='$locker_id'";

$conn->query($update);

echo "Parcel Stored Successfully<br>";

} else {

    echo "Error";
}
?>