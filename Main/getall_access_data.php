<?php
@session_start();
if (isset($_SESSION["role"])) {
    include "db_connect.php"; 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        }
        if ($search != '') {
            $sql = "SELECT * FROM access_details WHERE rolename LIKE '%$search%' OR course LIKE '%$search%'";
        }else{
            $sql = "SELECT * FROM access_details"; 
        }
        
        $result = $conn->query($sql);
        if ($result) {
            $rows = array(); 
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row; 
            }
            echo json_encode($rows); 
        } 
    } 
} else {
    echo json_encode(401);
}
?>