<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include "db_connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['grade'])) {
        $grade = $_POST['grade'];
    }
    if (isset($_POST['markrange'])) {
        $markrange = $_POST['markrange'];
    }
    if (isset($_POST['status'])) {
        $status = $_POST['status'];
    }
    if (isset($_POST['mode'])) {
        $mode = $_POST['mode'];
    }


    try {    
        if ($mode == 'add'){
            $sql = "INSERT INTO grade_details (grade, markrange, status)  VALUES ('$grade', '$markrange', '$status')";
        }else{
            $sql = "UPDATE grade_details SET status = '$status', markrange = '$markrange' WHERE grade = '$grade'";
        }

        $result = $conn->query($sql);
            if ($result) {
            $msg = 1; 
        }

    } catch (mysqli_sql_exception $e) {

    	$error = $e->getMessage();
        if (strpos($error, 'grade') !== false) {
            $msg = "Grade already found.";
        } else {
            $msg = "Error: " . $error; 
        }

    }

    echo json_encode($msg);
}
?>