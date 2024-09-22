<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include "db_connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['mode'])) {
        $mode = $_POST['mode'];
    }

    // Handling checkboxes in POST data
    $rolename = isset($_POST['rolename']) ? $_POST['rolename'] : '';
    $fullaccess = isset($_POST['fullaccess']) && $_POST['fullaccess'] == 'true' ? true : false;
    $viewstudent = isset($_POST['viewstudent']) && $_POST['viewstudent'] == 'true' ? true : false;
    $editstudent = isset($_POST['editstudent']) && $_POST['editstudent'] == 'true' ? true : false;
    $viewgrade = isset($_POST['viewgrade']) && $_POST['viewgrade'] == 'true' ? true : false;
    $editgrade = isset($_POST['editgrade']) && $_POST['editgrade'] == 'true' ? true : false;
    $viewstaff = isset($_POST['viewstaff']) && $_POST['viewstaff'] == 'true' ? true : false;
    $editstaff = isset($_POST['editstaff']) && $_POST['editstaff'] == 'true' ? true : false;
    $viewcourse = isset($_POST['viewcourse']) && $_POST['viewcourse'] == 'true' ? true : false;
    $editcourse = isset($_POST['editcourse']) && $_POST['editcourse'] == 'true' ? true : false;



    try {    
        if ($mode == 'add'){
            $sql = "INSERT INTO access_details (rolename, fullaccess, viewstudent, editstudent, viewstaff, editstaff, viewcourse, editcourse, viewgrade, editgrade) VALUES ('$rolename', '$fullaccess', '$viewstudent', '$editstudent', '$viewstaff', '$editstaff', '$viewcourse', '$editcourse', '$viewgrade', '$editgrade')";
        }else{
            $sql = "UPDATE access_details SET fullaccess = '$fullaccess', viewstudent = '$viewstudent', editstudent = '$editstudent', viewstaff = '$viewstaff',  editstaff = '$editstaff', viewcourse = '$viewcourse',  editcourse = '$editcourse',  viewgrade = '$viewgrade',  editgrade = '$editgrade' WHERE rolename = '$rolename'";
        }

        $result = $conn->query($sql);
            if ($result) {
            $msg = 1; 
        }

    } catch (mysqli_sql_exception $e) {

    	$error = $e->getMessage();
        if (strpos($error, 'course_id') !== false) {
            $msg = "Role detail already found.";
        } else {
            $msg = "Error: " . $error; 
        }

    }

    echo json_encode($msg);
}
?>