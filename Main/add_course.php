<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include "db_connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['courseid'])) {
        $courseid = $_POST['courseid'];
    }
    if (isset($_POST['course'])) {
        $course = $_POST['course'];
    }
    if (isset($_POST['duration'])) {
        $duration = $_POST['duration'];
    }
    if (isset($_POST['mode'])) {
        $mode = $_POST['mode'];
    }
    if (isset($_POST['courseyear'])) {
        $courseyear = $_POST['courseyear'];
    }
    if (isset($_POST['description'])) {
        $description = $_POST['description'];
    }

    try {    
        if ($mode == 'add'){
            $sql = "INSERT INTO course_details (courseid, course, duration, courseyear, description)  VALUES ('$courseid', '$course', '$duration', '$courseyear', '$description')";
        }else{
            $sql = "UPDATE course_details SET duration = '$duration', course = '$course', courseyear = '$courseyear', description = '$description' WHERE courseid = '$courseid'";
        }

        $result = $conn->query($sql);
            if ($result) {
            $msg = 1; 
        }

    } catch (mysqli_sql_exception $e) {

    	$error = $e->getMessage();
        if (strpos($error, 'course_id') !== false) {
            $msg = "Register number already found.";
        } else {
            $msg = "Error: " . $error; 
        }

    }

    echo json_encode($msg);
}
?>