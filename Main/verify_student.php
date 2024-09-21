<?php
include "db_connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['regnum'])) {
        $regnum = $_POST['regnum'];
    }
    if (isset($_POST['nic'])) {
        $nic = $_POST['nic'];
    }
    $sql =  "SELECT * FROM student_details WHERE register_number = '$regnum' AND nic = '$nic'";

    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        @session_start();
        $_SESSION['role'] = "student";
        $_SESSION['username'] = $row["student_name"];
        echo json_encode(1); 
    } else {
        echo json_encode(0); 
    }
}
?>