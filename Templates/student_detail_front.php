<?php 
@session_start(); 
if (isset($_SESSION["role"])) {
    if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "staff") {  
      include 'title.php';
      include 'sidemenu.php';
    }
}else{ ?>
  <header style="background: var(--primary-color) !important">
      <h3><i class="fa fa-universal-access" aria-hidden="true"></i>  Student Login</h3>
    </header>
<?php } 
include 'header.php';
?>
<?php if (isset($_SESSION["role"])) { ?>
      <div class="main">
        <div class="loader"></div>
    <?php include 'pageheader.php'; ?><br>
    <?php } ?>
    <!-- Verification -->
    <div class="custcontainer">
      <?php if (isset($_SESSION["role"])) { ?>
      <div class="authfield box w-mid" id="verifyfield">
        <?php }else{ ?>
          <div class="authfield box ww-mid" id="verifyfield">
        <?php } ?>
        <div id="registerform">
              <center><h4>Student Details</h4></center>
              <div class="alert hide" id="message">
              </div>
              <div class="row">

                <div class="col-md-12 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-info-circle"></i> Register Number</label>
                    <input type="text" class="input-field" type="text" placeholder="e.g) SR98492346" id="regnum"><br />
                  </div>
                </div>

                <div class="col-md-12 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-universal-access"></i> NIC</label>
                    <input type="text" class="input-field" type="text" placeholder="e.g) 197419202757" id="nic"><br />
                  </div>
                </div>

               
                 <div class="col-md-12 col-12 centercomponents">
                  <div class="form-group">
                    <?php if (isset($_SESSION["role"])) { ?>
                    <button type="button" id="getstudent_detail"><i class="fa fa-search"></i> Get Details</button>
                     <?php } else { ?>
                      <button type="button" id="student_login"><i class="fa fa-search"></i> Get Details</button>
                     <?php } ?>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>

          <!-- Verification End -->
        </div>
        <!-- Certification -->
<?php include 'footer.php' ?>



    