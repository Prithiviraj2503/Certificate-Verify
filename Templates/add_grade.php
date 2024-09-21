<?php 
@session_start(); 
if (!isset($_SESSION["role"]) || $_SESSION["role"] != "admin" ) {
    header("Location: index.php");
    exit;
}
include 'header.php';
if ($_SESSION["role"] == "admin") {  
  include 'title.php';
  include 'sidemenu.php';
 if (isset($_GET['mode'])){
  include '../Main/db_connect.php';
  if (isset($_GET['grade'])){
    $grade = $_GET['grade'];
    $row = [];
    $result = $conn->query("SELECT * FROM grade_details WHERE grade = '$grade' ");
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
} ?>

 <div id="mainContent" class="main">
  <input type="hidden" id="mode" value="<?php echo $_GET["mode"]; ?>">
  <?php include 'pageheader.php'; ?>
  <div class="custcontainer">
    <div class="loader"></div>
      <div class="authfield box" style="width: 99% !important">
        <div id="registerform">
              <div class="space-between" style="margin-bottom: 0.5em">
                  <h4>Add Course Details</h4>
                  <div>
                    <?php if(isset($_GET["mode"]) && $_GET["mode"] == 'add'){ ?>
                    <button type="button" id="addgradebtn"><i class="fa fa-plus-circle"></i> Save</button>
                    <?php } ?>
                    <?php if(isset($_GET["mode"]) && $_GET["mode"] == 'edit'){ ?>
                    <button type="button" id="addgradebtn"><i class="fa fa-pencil-square-o"></i> Update</button>
                    <?php } ?>
                  </div>
              </div>
              <div class="alert hide" id="message">
                
              </div>
              <div class="row">
                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-info-circle"></i> Grade </label>
                    <input type="text" class="input-field" type="text" placeholder="e.g) A+" id="grade" value="<?php if(isset($row["grade"])){ echo($row["grade"]); } ?>" <?php if(isset($row["grade"])){ echo "readonly=true"; } ?>  ><br />
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-user"></i> Mark Range</label>
                    <input type="text" class="input-field" type="text" placeholder="e.g) 90 - 100" id="markrange" value="<?php if(isset($row["markrange"])){ echo($row["markrange"]); } ?>"><br />
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-clock-o"></i> Status</label>
                    <input type="text" class="input-field" type="text" placeholder="e.g) Pass" id="status" value="<?php if(isset($row["status"])){ echo($row["status"]); } ?>"><br />
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>
      </div>
  <!-- </div> -->
<?php }else{ ?>
  <div class="centercontainer">
  <h4 style="text-align: center;">Sorry, Invalid Mode!</h4>
</div>
<?php }} else { ?> 
  <div class="centercontainer">
  <h4 style="text-align: center;">Sorry! You are not authorized to visit this page!</h4>
</div>
<?php } ?>
<?php include 'footer.php' ?>
