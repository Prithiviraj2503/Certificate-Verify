<?php
include "db_connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['adminid'])) {
        $adminid = $_POST['adminid'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }
    $sql =  "SELECT * FROM admin_details WHERE userid = '$adminid' AND password = '$password'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
         session_start();
         $_SESSION['role'] = 'admin'; 
         $_SESSION['username'] = $row['name']; 
         $_SESSION['userid'] = $row['userid'];  
         $_SESSION['access'] = 'admin';  
         echo json_encode(1); 
    } else {
        $sql =  "SELECT * FROM staff_details WHERE staffid = '$adminid' AND password = '$password'";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
             $row = $result->fetch_assoc();
             session_start();
             $_SESSION['role'] = 'staff'; 
             $_SESSION['username'] = $row['staffname']; 
             $_SESSION['userid'] = $row['staffid']; 
             echo json_encode(1); 
        }else{
            echo json_encode(0); 
        }
    }
}
?>