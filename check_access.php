<?php

include "db.php";

if(isset($_POST['phone'])) {

    $phone = $_POST['phone'];

    $sql = "SELECT * FROM users WHERE phone_number='$phone'";

    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        echo "ALLOW";
    } else {
        echo "DENY";
    }

} else {

    echo "No phone received";

}
?>