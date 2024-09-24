<?php
include "db_connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['staffid'])) {
        $staffid = $_POST['staffid'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }
    $sql =  "SELECT * FROM staff_details WHERE staffid = '$staffid' AND password = '$password'";

    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
         $row = $result->fetch_assoc();
         session_start();
         $_SESSION['role'] = 'staff'; 
         $_SESSION['username'] = $row['staffname'];
         $_SESSION['access'] = $row['rolename'];  
         echo json_encode(1); 
    } else {
        echo json_encode(0); 
    }
}
?>