<?php include 'header.php' ?>
    <header style="background: var(--primary-color) !important">
      <h3><i class="fa fa-universal-access" aria-hidden="true"></i>  Admin Login</h3>
    </header>
  <div class="custcontainer">
    <div class="loader"></div>

    <!-- Verification -->
      <div class="authfield box ww-mid" id="verifyfield">
        <div id="registerform">
              <center><h4>Admin Details</h4></center>
              <div class="alert hide" id="message">
              </div>
              <div class="row">

                <div class="col-md-12 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-info-circle"></i> User ID</label>
                    <input type="text" class="input-field" type="text" placeholder="e.g) Lushanth" id="adminid"><br />
                  </div>
                </div>

                <div class="col-md-12 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-lock"></i> Password</label>
                    <input type="password" class="input-field" type="text" placeholder="e.g) ********" id="password"><br />
                  </div>
                </div>

                 <div class="col-md-12 col-12 centercomponents">
                  <div class="form-group">
                    <button type="button" id="admin_login">Login <i class="fa fa-location-arrow"></i></button>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
<?php include 'footer.php' ?>
