<?php
@session_start();
if (isset($_SESSION["role"])) {
    include "db_connect.php"; 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        }
        if ($search != '') {
            $sql = "SELECT * FROM grade_details WHERE grade LIKE '%$search%' OR markrange LIKE '%$search%'";
        }else{
            $sql = "SELECT * FROM grade_details"; 
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