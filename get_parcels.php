<?php
include "db.php";

$sql = "SELECT p.parcel_id, u.name, l.locker_id, p.status
        FROM parcels p
        JOIN users u ON p.user_id = u.UserID
        JOIN lockers l ON p.locker_id = l.locker_id";

$result = $conn->query($sql);

$data = array();

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>