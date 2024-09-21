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
  if (isset($_GET['regnum'])){
    $regnum = $_GET['regnum'];
    $row = [];
    $result = $conn->query("SELECT * FROM student_details WHERE register_number = '$regnum' ");
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
} ?>

 <div id="mainContent" class="main">
  <input type="hidden" id="mode" value="<?php echo $_GET["mode"]; ?>">
  <?php include "pageheader.php"; ?>
  <div class="custcontainer">
    <div class="loader"></div>
      <div class="authfield box" style="width: 99% !important">
        <div id="registerform">
              <div class="space-between" style="margin-bottom: 0.5em">
                  <h4>Add Student Details</h4>
                  <div>
                    <?php if(isset($_GET["mode"]) && $_GET["mode"] == 'add'){ ?>
                    <button type="button" id="registerbtn"><i class="fa fa-plus-circle"></i> Save</button>
                    <?php } ?>
                    <?php if(isset($_GET["mode"]) && $_GET["mode"] == 'edit'){ ?>
                    <button type="button" id="registerbtn"><i class="fa fa-pencil-square-o"></i> Update</button>
                    <?php } ?>
                  </div>
              </div>
              <div class="alert hide" id="message">
                
              </div>
              <div class="row">
                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-info-circle"></i> Register Number</label>
                    <input type="text" class="input-field" type="text" placeholder="e.g) SR98492346" id="regnum" value="<?php if(isset($row["register_number"])){ echo($row["register_number"]); } ?>" <?php if(isset($row["register_number"])){ echo "readonly=true"; } ?>  ><br />
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-user"></i> Student Name</label>
                    <input type="text" class="input-field" type="text" placeholder="e.g) Lushanth" id="name" value="<?php if(isset($row["student_name"])){ echo($row["student_name"]); } ?>"><br />
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-universal-access"></i> NIC</label>
                    <input type="text" class="input-field" type="text" placeholder="e.g) 197419202757" id="nic" value="<?php if(isset($row["nic"])){ echo($row["nic"]); } ?>"><br />
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-users"></i> Gender</label><br />
                    <select class="input-field" id="gender">
                        <option value="">Select a gender</option>
                        <option value="Male" <?php if (isset($row["gender"]) && $row["gender"] == "Male") echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if (isset($row["gender"]) && $row["gender"] == "Female") echo 'selected'; ?>>Female</option>
                        <option value="Others" <?php if (isset($row["gender"]) && $row["gender"] == "Others") echo 'selected'; ?>>Others</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-book"></i> Course</label><br />
                    <select class="input-field" id="course">
                        <option value="">Select a course</option>
                       <?php foreach ($crow as $course) {
                          if (isset($row["course"])) {
                            $selectedCourse = $row["course"];
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
                    <label><i class="fa fa-hourglass-1"></i> Duration</label><br />
                    <input type="text" name="duration" id="duration" class="input-field" value="<?php if(isset($row["duration"])){ echo($row["duration"]); } ?>" placeholder="e.g) 3">
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-clock-o"></i> Academic Year</label>
                    <input type="month" class="input-field" type="text" placeholder="e.g) 12/09/2024" id="acyear" value="<?php if(isset($row["acyear"])){ echo($row["acyear"]); } ?>"><br />
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-bookmark"></i> Final Grade</label><br />
                    <select class="input-field" id="grade">
                        <option value="">Select a grade</option>
                        <option value="A" <?php if (isset($row["final_grade"]) && $row["final_grade"] == "A") echo 'selected'; ?>>A</option>
                        <option value="B" <?php if (isset($row["final_grade"]) && $row["final_grade"] == "B") echo 'selected'; ?>>B</option>
                        <option value="C" <?php if (isset($row["final_grade"]) && $row["final_grade"] == "C") echo 'selected'; ?>>C</option>
                        <option value="D" <?php if (isset($row["final_grade"]) && $row["final_grade"] == "D") echo 'selected'; ?>>D</option>
                        <option value="Fail" <?php if (isset($row["final_grade"]) && $row["final_grade"] == "Fail") echo 'selected'; ?>>Fail</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-address-card-o"></i> Certificate Number</label>
                    <input type="text" class="input-field" type="text" placeholder="e.g) CERT101" id="certnum" value="<?php if(isset($row["certificate_number"])){ echo($row["certificate_number"]); } ?>" ><br />
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-graduation-cap"></i> Certificate Issue Date</label>
                    <input type="date" class="input-field" type="text" placeholder="e.g) 12/09/2024" id="certdate" value="<?php if(isset($row["certificate_issue_date"])){ echo($row["certificate_issue_date"]); } ?>"><br />
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-certificate"></i> Certificate</label>
                    <input type="file" accept=".pdf" class="input-field" id="certfile" name="certificate" >
                    <?php if (isset($row["certificate"])): ?>
                      <br />
                      <p id="curfile">Current file: 
                        <a href="../Assets/useruploads/certificates/<?php echo $row['certificate']; ?>" 
                           target="_blank" 
                           id="currentFile">
                           <?php echo $row['certificate']; ?>
                        </a>
                      </p>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-graduation-cap"></i> Capping Date</label>
                    <input type="date" class="input-field" type="text" placeholder="e.g) 12/09/2024" id="capdate" value="<?php if(isset($row["capping_date"])){ echo($row["capping_date"]); } ?>"><br />
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
