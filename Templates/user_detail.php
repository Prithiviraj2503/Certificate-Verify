<?php 
@session_start(); 
if (!isset($_SESSION["role"]) ) {
    header("Location: index.php");
    exit;
}else{
  include 'header.php';
  include 'title.php';
  include 'sidemenu.php';
  if (isset($_SESSION['userid'])){
      $userid = $_SESSION['userid'];
      $row = [];
      include '../Main/db_connect.php';
      if ($_SESSION["role"] == "admin") {
        $result = $conn->query("SELECT * FROM admin_details WHERE userid = '$userid' ");
      }else{
        $result = $conn->query("SELECT * FROM staff_details WHERE staffid = '$userid' ");
      }
      if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
      }
  }
  
}
?>

 <div id="mainContent" class="main">
  <?php include "pageheader.php"; ?>
  <div class="custcontainer">
    <div class="loader"></div>
      <div class="authfield box" style="width: 99% !important">
        <div id="registerform">
            <div class="space-between" style="margin-bottom: 0.5em">
                <h4>User Details</h4>
                <div>
                  <button type="button" id="registerbtn"><i class="fa fa-pencil-square-o"></i> Update</button>
                </div>
              </div>
              <input type="hidden" name="" id="role" value="<?php if(isset($_SESSION["role"])){ echo $_SESSION["role"]; } ?>">
              
              <div class="row">

                <?php if(isset($_SESSION["role"])){ if ($_SESSION["role"] == "admin") { ?>
                    <div class="col-md-4 col-12">
                      <div class="form-group">
                        <label><i class="fa fa-info-circle"></i> User ID</label>
                        <input type="text" class="input-field" type="text" placeholder="e.g) SR98492346" id="userid" value="<?php if(isset($row["userid"])){ echo($row["userid"]); } ?>" <?php if(isset($row["userid"])){ echo "readonly=true"; } ?>  ><br />
                      </div>
                    </div>

                    <div class="col-md-4 col-12">
                      <div class="form-group">
                        <label><i class="fa fa-user"></i> User Name</label>
                        <input type="text" class="input-field" type="text" placeholder="e.g) Lushanth" id="username" value="<?php if(isset($row["name"])){ echo($row["name"]); } ?>"><br />
                      </div>
                    </div>
                <?php } else { ?>
                  <div class="col-md-4 col-12">
                      <div class="form-group">
                        <label><i class="fa fa-info-circle"></i> User ID</label>
                        <input type="text" class="input-field" type="text" placeholder="e.g) SR98492346" id="staffid" value="<?php if(isset($row["staffid"])){ echo($row["staffid"]); } ?>" <?php if(isset($row["staffid"])){ echo "readonly=true"; } ?>  ><br />
                      </div>
                    </div>

                    <div class="col-md-4 col-12">
                      <div class="form-group">
                        <label><i class="fa fa-user"></i> User Name</label>
                        <input type="text" class="input-field" type="text" placeholder="e.g) Lushanth" id="staffname" value="<?php if(isset($row["staffname"])){ echo($row["staffname"]); } ?>"><br />
                      </div>
                    </div>
                <?php }} ?>
                
                <div class="col-md-4 col-12"></div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-envelope-o"></i> Email</label>
                    <input type="text" class="input-field" type="text" placeholder="e.g) abc@gmail.com" id="email" value="<?php if(isset($row["email"])){ echo($row["email"]); } ?>"><br />
                  </div>
                </div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-phone"></i> Phone</label>
                    <input type="text" class="input-field" type="text" placeholder="e.g) 197419202757" id="phone" value="<?php if(isset($row["phone"])){ echo($row["phone"]); } ?>"><br />
                  </div>
                </div>
                <div class="col-md-4 col-12"></div>

                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-key"></i> Password</label>
                    <input type="password" class="input-field" type="text" placeholder="e.g) *****" id="password" value="<?php if(isset($row["password"])){ echo($row["password"]); } ?>"><br />
                  </div>
                </div>



              </div>
            </div>
          </div>
        </div>
      </div>
      