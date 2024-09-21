<?php
@session_start();
if (isset($_SESSION["role"])){
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
            echo json_encode($row); 
        } else {
            echo json_encode(0); 
        }
    }
    
}else{
     echo json_encode(401); 
}

?>