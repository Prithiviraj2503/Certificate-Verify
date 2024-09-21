<?php
include "db_connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['grade'])) {
    $grade = $_POST['grade'];
}
$msg = 0; 
$query = "DELETE FROM grade_details WHERE grade='$grade'"; 
$result = $conn->query($query);
    if ($result) {
    $msg = 1; 
}
}
echo json_encode($msg);
?>