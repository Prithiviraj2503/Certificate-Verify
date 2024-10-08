<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include "db_connect.php";

if (isset($_POST['excelData'])) {
    $excelData = json_decode($_POST['excelData'], true); 

    // Skip the header row and sample data., start processing the data
    for ($i = 2; $i < count($excelData); $i++) {
        $row = $excelData[$i];
        $regnum = $conn->real_escape_string($row[0]);
        $name = $conn->real_escape_string($row[1]);
        $nic = $conn->real_escape_string($row[2]);
        $gender = $conn->real_escape_string($row[3]);
        $course = $conn->real_escape_string($row[4]);
        $duration = $conn->real_escape_string($row[5]);
        $acyear = $conn->real_escape_string($row[6]);
        $grade = $conn->real_escape_string($row[7]);
        $certnum = $conn->real_escape_string($row[8]);
        $certdate = $conn->real_escape_string($row[9]);
        $certfile = $conn->real_escape_string($row[10]);
        $capdate = $conn->real_escape_string($row[11]);
        
        $sql = "INSERT INTO student_details 
            (register_number, student_name, nic, course, certificate_number, certificate_issue_date, final_grade, gender, duration, capping_date, certificate, acyear) 
            VALUES ('$regnum', '$name', '$nic', '$course', '$certnum', '$certdate', '$grade', '$gender', '$duration', '$capdate', '$certfile', '$acyear')";

        if (!$conn->query($sql)) {
            echo "Error: " . $sql . "<br>" . $conn->error;
            exit;
        }
    }

    $conn->close();
    echo "Data has been successfully uploaded!";
} else {
    echo "No data received.";
}
?>
