<?php
include "db_connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['regnum'])) {
    $regnum = $_POST['regnum'];
}
$msg = 0; 
$query = "DELETE FROM student_details WHERE register_number='$regnum'"; 
$result = $conn->query($query);
    if ($result) {
    $msg = 1; 
}
}
echo json_encode($msg);
?>