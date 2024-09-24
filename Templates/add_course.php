<?php 
@session_start(); 
include 'header.php';
if ($_SESSION["role"] == "admin" || ($_SESSION["role"] == "staff" && $accessdata["editcourse"] == true)) {  
  include 'title.php';
  include 'sidemenu.php';
 if (isset($_GET['mode'])){
  include '../Main/db_connect.php';
  if (isset($_GET['courseid'])){
    $courseid = $_GET['courseid'];
    $row = [];
    $result = $conn->query("SELECT * FROM course_details WHERE courseid = '$courseid' ");
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
                    <button type="button" id="addcoursebtn"><i class="fa fa-plus-circle"></i> Save</button>
                    <?php } ?>
                    <?php if(isset($_GET["mode"]) && $_GET["mode"] == 'edit'){ ?>
                    <button type="button" id="addcoursebtn"><i class="fa fa-pencil-square-o"></i> Update</button>
                    <?php } ?>
                  </div>
              </div>
              <div class="alert hide" id="message">
                
              </div>
              <div class="row">
                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-info-circle"></i> Course ID</label>
                    <input type="text" class="input-field" type="text" placeholder="e.g) SR98492346" id="courseid" value="<?php if(isset($row["courseid"])){ echo($row["courseid"]); } ?>" <?php if(isset($row["courseid"])){ echo "readonly=true"; } ?>  ><br />
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-user"></i> Course</label>
                    <input type="text" class="input-field" type="text" placeholder="e.g) C++" id="coursev" value="<?php if(isset($row["course"])){ echo($row["course"]); } ?>"><br />
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-clock-o"></i> Duration</label>
                    <input type="text" class="input-field" type="text" placeholder="e.g) 2 Months" id="duration" value="<?php if(isset($row["duration"])){ echo($row["duration"]); } ?>"><br />
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-clock-o"></i> Course Year</label>
                    <input type="month" class="input-field" type="text" placeholder="e.g) 12/09/2024" id="courseyear" value="<?php if(isset($row["courseyear"])){ echo($row["courseyear"]); } ?>"><br />
                  </div>
                </div>

                <div class="col-md-4 col-12"></div>
                <div class="col-md-4 col-12"></div>

                <div class="col-md-12 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-clock-o"></i> Description</label>
                    <textarea class="input-field" type="text" placeholder="e.g) The course is about ..." id="description"><?php if(isset($row["description"])){ echo($row["description"]); } ?></textarea><br />
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
