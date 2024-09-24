<?php 
@session_start(); 
if (!isset($_SESSION["role"])) {
    header("Location: index.php");
    exit;
}
include 'header.php';
if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "staff") {  
  include 'title.php';
  include 'sidemenu.php';
}
?>
<div id="mainContent" class="main">
  <?php include 'pageheader.php'; ?>
  <div class="custcontainer">
    <div class="loader"></div>
      <div class="authfield box" style="width: 99%">
      	<div class="alert hide" id="message"></div>
        <div class="space-between">
              <h5 id="totalgrade">Total Grades : 0</h5>
              <input type="text" id="searchinput" class="input-field" placeholder="&#128269; Search Grade" style="width: 25%; padding: 5px">
          </div>
          <style type="text/css">
            td{
              text-align: center;
            }
          </style>
          <table id="example" class="table table-bordered" style="width:100%;">
            <thead class="white" style="background: var(--primary-dark)">
                <tr>
                    <th>S. No</th>
                    <th>Grade</th>
                    <th>Mark Range</th>
                    <th>Status</th>
                    <?php if ($_SESSION["role"] == "admin" || ($_SESSION["role"] == "staff" && $accessdata["editgrade"] == true)) {  ?>
                    <th>Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody id="gradelist">
               	
            </tbody>
        </table>
    </div>

      </div>
  </div>
</div>
<?php include 'footer.php' ?>
