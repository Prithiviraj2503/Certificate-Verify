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
$crow = [];
$crs = $conn->query("SELECT * FROM course_details");
if ($crs && $crs->num_rows > 0) {
    $crow = $crs->fetch_all(MYSQLI_ASSOC);
}
if (isset($_GET['staffid'])){
    $staffid = $_GET['staffid'];
    $row = [];
    $result = $conn->query("SELECT * FROM staff_details WHERE staffid = '$staffid' ");
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
                    <button type="button" id="addstaffbtn"><i class="fa fa-plus-circle"></i> Save</button>
                    <?php } ?>
                    <?php if(isset($_GET["mode"]) && $_GET["mode"] == 'edit'){ ?>
                    <button type="button" id="addstaffbtn"><i class="fa fa-pencil-square-o"></i> Update</button>
                    <?php } ?>
                  </div>
              </div>
              <div class="alert hide" id="message">
                
              </div>
              <div class="row">
                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-info-circle"></i> Staff ID</label>
                    <input type="text" class="input-field" type="text" placeholder="e.g) SR98492346" id="staffid" value="<?php if(isset($row["staffid"])){ echo($row["staffid"]); } ?>" <?php if(isset($row["staffid"])){ echo "readonly=true"; } ?>  ><br />
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-user"></i> Staff Name</label>
                    <input type="text" class="input-field" type="text" placeholder="e.g) C++" id="staffname" value="<?php if(isset($row["staffname"])){ echo($row["staffname"]); } ?>"><br />
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-book"></i> Department</label><br />
                    <select class="input-field" id="department">
                        <option value="">Select a course</option>
                       <?php foreach ($crow as $course) {
                          if (isset($row["department"])) {
                            $selectedCourse = $row["department"];
                          }
                          $coursename = $course['course'];
                          $isSelected = ($coursename === $selectedCourse) ? ' selected' : '';
                          echo "<option value=\"{$coursename}\"{$isSelected}>{$coursename}</option>";
                        } ?>
                    </select>
                  </div>
                </div>


                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-clock-o"></i> Password</label>
                    <input type="password" class="input-field" type="text" placeholder="e.g) ******" id="password" value="<?php if(isset($row["password"])){ echo($row["password"]); } ?>"><br />
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-user"></i> Email</label>
                    <input type="text" class="input-field" type="text" placeholder="e.g) staff@gmail.com" id="email" value="<?php if(isset($row["email"])){ echo($row["email"]); } ?>"><br />
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-user"></i> Phone</label>
                    <input type="text" class="input-field" type="text" placeholder="e.g) 8757836578" id="phone" value="<?php if(isset($row["phone"])){ echo($row["phone"]); } ?>"><br />
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
