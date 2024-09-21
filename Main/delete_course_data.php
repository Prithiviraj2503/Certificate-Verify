<?php
include "db_connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['courseid'])) {
    $courseid = $_POST['courseid'];
}
$msg = 0; 
$query = "DELETE FROM course_details WHERE courseid='$courseid'"; 
$result = $conn->query($query);
    if ($result) {
    $msg = 1; 
}
}
echo json_encode($msg);
?>