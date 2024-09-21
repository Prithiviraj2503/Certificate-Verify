<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include "db_connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['staffid'])) {
        $staffid = $_POST['staffid'];
    }
    if (isset($_POST['staffname'])) {
        $staffname = $_POST['staffname'];
    }
    if (isset($_POST['department'])) {
        $department = $_POST['department'];
    }
    if (isset($_POST['mode'])) {
        $mode = $_POST['mode'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (isset($_POST['phone'])) {
        $phone = $_POST['phone'];
    }

    try {    
        if ($mode == 'add'){
            $sql = "INSERT INTO staff_details (staffid, staffname, department, password, email, phone)  VALUES ('$staffid', '$staffname', '$department', '$password', '$email', '$phone')";
        }else{
            $sql = "UPDATE staff_details SET staffname = '$staffname', department = '$department', password = '$password', email = '$email', phone = '$phone' WHERE staffid = '$staffid'";
        }

        $result = $conn->query($sql);
            if ($result) {
            $msg = 1; 
        }

    } catch (mysqli_sql_exception $e) {

    	$error = $e->getMessage();
        if (strpos($error, 'course_id') !== false) {
            $msg = "Staff ID  already found.";
        } else {
            $msg = "Error: " . $error; 
        }

    }

    echo json_encode($msg);
}
?>