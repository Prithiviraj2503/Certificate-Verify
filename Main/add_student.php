<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include "db_connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['regnum'])) {
        $regnum = $_POST['regnum'];
    }
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (isset($_POST['nic'])) {
        $nic = $_POST['nic'];
    }
    if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
    }
    if (isset($_POST['course'])) {
        $course = $_POST['course'];
    }
    if (isset($_POST['duration'])) {
        $duration = $_POST['duration'];
    }
    if (isset($_POST['grade'])) {
        $grade = $_POST['grade'];
    }
    if (isset($_POST['certnum'])) {
        $certnum = $_POST['certnum'];
    }
    if (isset($_POST['certdate'])) {
        $certdate = $_POST['certdate'];
    }
    if (isset($_POST['capdate'])) {
        $capdate = $_POST['capdate'];
    }
    if (isset($_POST['mode'])) {
        $mode = $_POST['mode'];
    }
    if (isset($_POST['acyear'])) {
        $acyear = $_POST['acyear'];
    }

    if (isset($_FILES['certfile']) && $_FILES['certfile']['error'] == 0) {
            $certfile = $_FILES['certfile']['name'];
            $target_dir = "../Assets/useruploads/certificates/";  
            $target_file = $target_dir . basename($certfile);
            move_uploaded_file($_FILES['certfile']['tmp_name'], $target_file);
        }

    try {    
        if ($mode == 'add'){
            $sql = "INSERT INTO student_details 
            (register_number, student_name, nic, course, certificate_number, certificate_issue_date, final_grade, gender, duration, capping_date, certificate, acyear) 
            VALUES ('$regnum', '$name', '$nic', '$course', '$certnum', '$certdate', '$grade', '$gender', '$duration', '$capdate', '$certfile', '$acyear')";
        }else{
            $sql = "UPDATE student_details SET student_name = '$name', nic = '$nic', course = '$course', certificate_number = '$certnum', certificate_issue_date = '$certdate', final_grade = '$grade', gender = '$gender', duration = '$duration', capping_date = '$capdate', acyear='$acyear' ";
            if (!empty($certfile)) {
                $sql .= ", certificate = '$certfile'";
            }
            $sql .= " WHERE register_number = '$regnum' ";
        }

        $result = $conn->query($sql);
            if ($result) {
            $msg = 1; 
        }

    } catch (mysqli_sql_exception $e) {
        $error = $e->getMessage();
        if (strpos($error, 'register_number') !== false) {
            $msg = "Register number already found.";
        } elseif (strpos($error, 'nic') !== false) {
            $msg = "NIC already found.";
        } elseif (strpos($error, 'certificate_number') !== false) {
            $msg = "Certificate number already found.";
        } else {
            $msg = "Error: " . $error; 
        }
    }
    }

    echo json_encode($msg);
?>