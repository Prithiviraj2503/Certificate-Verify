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
    if (isset($_GET['roleid'])){
      $roleid = $_GET['roleid'];
      $row = [];
      $result = $conn->query("SELECT * FROM access_details WHERE roleid = '$roleid' ");
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
                  <h4>Access Settings</h4>
                  <div>
                    <?php if(isset($_GET["mode"]) && $_GET["mode"] == 'add'){ ?>
                    <button type="button" id="addaccessbtn"><i class="fa fa-plus-circle"></i> Save</button>
                    <?php } ?>
                    <?php if(isset($_GET["mode"]) && $_GET["mode"] == 'edit'){ ?>
                    <button type="button" id="addaccessbtn"><i class="fa fa-pencil-square-o"></i> Update</button>
                    <?php } ?>
                  </div>
              </div>
              <div class="alert hide" id="message">
              </div>
              <div class="row">
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label><i class="fa fa-user-circle"></i> Role</label>
                        <input type="text" class="input-field" type="text" placeholder="e.g) Full Authority" id="rolename" value="<?php if(isset($row["rolename"])){ echo($row["rolename"]); } ?>" <?php if(isset($row["rolename"])){ echo "readonly=true"; } ?>  ><br />
                    </div>
                </div>
                
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label style="visibility:hidden"><i class="fa fa-user-circle"></i> Role</label>
                        <div class="custom-checkbox-container">
                            <div>
                            <input type="checkbox" class="custom-checkbox" id="selectall" <?php if (isset($row["fullaccess"]) && $row["fullaccess"]) { echo 'checked'; } ?>>
                            </div>
                            <div>
                                <label for="selectall">Select All Access</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-12"></div>

                <!-- Student Access -->
                <div class="col-md-12 col-12">
                    <div class="maincard-title gray bold">Student Access</div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="flex-row">
                        <div class="custom-checkbox-container">
                            <div>
                                <input type="checkbox" class="custom-checkbox" id="viewstudent" <?php if (isset($row["viewstudent"]) && $row["viewstudent"]) { echo 'checked'; } ?>>
                            </div>
                            <div>
                                <label for="viewstudent">View</label>
                            </div>
                        </div>
                        <div class="custom-checkbox-container">
                            <div>
                                <input type="checkbox" class="custom-checkbox" id="editstudent" <?php if (isset($row["editstudent"]) && $row["editstudent"]) { echo 'checked'; } ?>>
                            </div>
                            <div>
                                <label for="editstudent">Edit</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Staff Access -->
                <div class="col-md-12 col-12">
                    <div class="maincard-title gray bold">Staff Access</div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="flex-row">
                        <div class="custom-checkbox-container">
                            <div>
                                <input type="checkbox" class="custom-checkbox" id="viewstaff" <?php if (isset($row["viewstaff"]) && $row["viewstaff"]) { echo 'checked'; } ?>>
                            </div>
                            <div>
                                <label for="viewstaff">View</label>
                            </div>
                        </div>
                        <div class="custom-checkbox-container">
                            <div>
                                <input type="checkbox" class="custom-checkbox" id="editstaff" <?php if (isset($row["editstaff"]) && $row["editstaff"]) { echo 'checked'; } ?>>
                            </div>
                            <div>
                                <label for="editstaff">Edit</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Course Access -->
                <div class="col-md-12 col-12">
                    <div class="maincard-title gray bold">Course Access</div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="flex-row">
                        <div class="custom-checkbox-container">
                            <div>
                                <input type="checkbox" class="custom-checkbox" id="viewcourse" <?php if (isset($row["viewcourse"]) && $row["viewcourse"]) { echo 'checked'; } ?>>
                            </div>
                            <div>
                                <label for="viewcourse">View</label>
                            </div>
                        </div>
                        <div class="custom-checkbox-container">
                            <div>
                                <input type="checkbox" class="custom-checkbox" id="editcourse" <?php if (isset($row["editcourse"]) && $row["editcourse"]) { echo 'checked'; } ?>>
                            </div>
                            <div>
                                <label for="editcourse">Edit</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grade Access -->
                <div class="col-md-12 col-12">
                    <div class="maincard-title gray bold">Grade Access</div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="flex-row">
                        <div class="custom-checkbox-container">
                            <div>
                                <input type="checkbox" class="custom-checkbox" id="viewgrade" <?php if (isset($row["viewgrade"]) && $row["viewgrade"]) { echo 'checked'; } ?>>
                            </div>
                            <div>
                                <label for="viewgrade">View</label>
                            </div>
                        </div>
                        <div class="custom-checkbox-container">
                            <div>
                                <input type="checkbox" class="custom-checkbox" id="editgrade" <?php if (isset($row["editgrade"]) && $row["editgrade"]) { echo 'checked'; } ?>>
                            </div>
                            <div>
                                <label for="editgrade">Edit</label>
                            </div>
                        </div>
                    </div>
                </div>

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
