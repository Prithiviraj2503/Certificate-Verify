<?php
include "db_connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['staffid'])) {
    $staffid = $_POST['staffid'];
}
$msg = 0; 
$query = "DELETE FROM staff_details WHERE staffid='$staffid'"; 
$result = $conn->query($query);
    if ($result) {
    $msg = 1; 
}
}
echo json_encode($msg);
?>