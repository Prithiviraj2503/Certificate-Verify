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
} 
?>


 <div id="mainContent" class="main">
  <?php include "pageheader.php"; ?>
  <div class="custcontainer">
    <div class="loader"></div>
      <div class="authfield box" style="width: 99% !important">
        <div id="registerform">
        	<div class="alert hide" id="message"></div>
        	<div class="row">
                <div class="col-md-4 col-12">
                  <div class="form-group">
                    <label><i class="fa fa-info-circle"></i> File Data</label>
                    <input type="file" class="input-field" placeholder="e.g) SR98492346" id="studentbulkdata" accept=".xlsx, .xls"  ><br />
                  </div>
                </div>
                <div class="col-md-4 col-12">
                	<div class="form-group">
                		<label style="visibility: hidden;"><i class="fa fa-info-circle"></i> File Data</label>
                		<button type="button" id="registerbtn"><i class="fa fa-plus-circle"></i> Save</button>
                	</div>
                </div>

        </div>
      </div>
	</div>
	</div>

	<?php include 'footer.php'; ?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
	<script type="text/javascript">
		 $(document).ready(function() {
            $("#registerbtn").on('click', function(event) {
                var file = event.target.files[0];
                if (!file) {
                    alert("No file selected.");
                    return;
                }

                var reader = new FileReader();

                reader.onload = function(e) {
                    var data = new Uint8Array(e.target.result);
                    var workbook = XLSX.read(data, {type: 'array'});
                    var firstSheet = workbook.Sheets[workbook.SheetNames[0]];

                    var excelData = XLSX.utils.sheet_to_json(firstSheet, {header: 1});
                    $(".loader").show()
                    $.ajax({
                        url: 'process_bulkstudent.php',
                        type: 'POST',
                        data: {excelData: JSON.stringify(excelData)},
                        success: function(response) {
                    		$(".loader").hide()
                            message("Data Added Successfully")
                        },
                        error: function(xhr, status, error) {
                            message("AJAX Error: ", status, error);
                        }
                    });
                };

                reader.readAsArrayBuffer(file);
            });
        });
	</script>