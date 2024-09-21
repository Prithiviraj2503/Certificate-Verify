<?php
include "db_connect.php"; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['course'])) {
        $course = $_POST['course'];

        $query = "SELECT duration FROM course_details WHERE course = '$course'";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $duration = $row['duration'];
        }

        echo json_encode($duration);
    }
}
?>