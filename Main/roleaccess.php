<?php
    @session_start();
    if(isset($_SESSION["access"])){
        $access = $_SESSION["access"];
        $accessdata = [];
        include '../Main/db_connect.php';
        $result = $conn->query("SELECT * FROM access_details WHERE rolename = '$access' ");
        if ($result && $result->num_rows > 0) {
            $accessdata = $result->fetch_assoc();
        }
    }
?>