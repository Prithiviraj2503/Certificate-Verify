<?php 
@session_start(); 
if (!isset($_SESSION["role"])) {
    header("Location: index.php");
    exit;
}
include 'header.php';
if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "staff" || $_SESSION["role"] == "student") {  
  include 'title.php';
  include 'sidemenu.php';
  if (isset($_GET['regnum'])){
    $regnum = $_GET['regnum'];
    include '../Main/db_connect.php';
    $row = [];
    $result = $conn->query("SELECT * FROM student_details WHERE register_number = '$regnum' ");
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
  if (sizeof($row) > 0){ ?>

<div id="mainContent" class="main">
  <input type="hidden" id="role" value="<?php echo($_SESSION["role"]); ?>">
  <?php include 'pageheader.php'; ?><br>
  <div class="loader"></div>
<!-- Certification -->
 <div id="certify">
    <div class="row">
      <style type="text/css">
        td {
            text-align: left;
        }
        td:first-child {
            width: 40%;
            text-align: left;
        }
        td:nth-child(2) {
            width: 10%;
            text-align: center;
        }
        td:nth-child(3) {
            width: 40%;
            text-align: left;
        }
    </style>
      <!-- Data -->
      <div class="col-md-6 col-12">

         <table class="table border studentdata">
            <tr>
                <td class="label">Registration Number</td>
                <td>:</td>
                <td class="regnum"><?php echo $row["register_number"]; ?></td>
            </tr>
            <tr>
                <td class="label">Student Name:</td>
                <td>:</td>
                <td class="studname"><?php echo $row["student_name"]; ?></td>
            </tr>
            <tr>
                <td class="label">NIC:</td>
                <td>:</td>
                <td class="nic"><?php echo $row["nic"]; ?></td>
            </tr>
            <tr>
                <td class="label">Gender:</td>
                <td>:</td>
                <td class="gender"><?php echo $row["gender"]; ?></td>
            </tr>
            <tr>
                <td class="label">Course:</td>
                <td>:</td>
                <td class="course"><?php echo $row["course"]; ?></td>
            </tr>
            <tr>
                <td class="label">Academic Year:</td>
                <td>:</td>
                <td class="certduration"><?php echo $row["acyear"]; ?></td>
            </tr>
            <tr>
                <td class="label">Duration:</td>
                <td>:</td>
                <td class="certduration"><?php echo $row["duration"]; ?></td>
            </tr>
            <tr>
                <td class="label">Certificate Number:</td>
                <td>:</td>
                <td class="certnum"><?php echo $row["certificate_number"]; ?></td>
            </tr>
            <tr>
                <td class="label">Certificate Issue Date:</td>
                <td>:</td>
                <td class="certdate"><?php echo $row["certificate_issue_date"]; ?></td>
            </tr>
            <tr>
                <td class="label">Final Grade:</td>
                <td>:</td>
                <td class="grade"><?php echo $row["final_grade"]; ?></td>
            </tr>
            <tr>
                <td class="label">Capping Date:</td>
                <td>:</td>
                <td class="capdate"><?php echo $row["capping_date"]; ?></td>
            </tr>
        </table>
      </div>

      <!-- Certificate -->
      <div class="col-md-6 col-12" id="certificate">
          <embed src="../Assets/useruploads/certificates/<?php echo $row['certificate']; ?>" 
                 type="application/pdf" 
                 style="width:95%;height: 97%; border: 1px solid gray;" />
      </div>

</div>
</div>
</div>

<?php } else { ?>
<div class="centercontainer">
  <h4 style="text-align: center;">Sorry! The requested data not available!</h4>
</div>
<?php } }else{ ?>
  <div class="centercontainer">
  <h4 style="text-align: center;">Sorry! The register number is empty!</h4>
</div>
<?php } ?>
<?php } else { ?>
<div class="centercontainer">
  <h4 style="text-align: center;">Sorry! You are not authorized to visit this page!</h4>
</div>
<?php } ?>
<?php include 'footer.php' ?>



    