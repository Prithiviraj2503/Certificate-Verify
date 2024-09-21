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
                    <input type="file" class="input-field"  id="studentbulkdata" accept=".xlsx, .xls"  ><br />
                  </div>
                </div>
                <div class="col-md-4 col-12"></div>
                <div class="col-md-4 col-12"></div>
                <div class="col-md-2 col-12">
                	<div class="form-group">
                		<button type="button" id="registerbtn" class="w-100"><i class="fa fa-upload"></i> Bulk Import</button>
                	</div>
                </div>
                <div class="col-md-3 col-12">
                	<div class="form-group">
                		<button type="button" id="sampledata" class="w-100"><i class="fa fa-download"></i> Download Sample</button>
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

            $("#sampledata").click(function(){
              window.location.href = "../Assets/samplefiles/studentsampledata.xlsx"
            })

            $("#registerbtn").click( function(event) {
                let finput = $("#studentbulkdata")[0];
                var file = finput.files[0];
                if (!file) {
                    message("error","No file selected.");
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
                        url: '../Main/process_bulkstudent.php',
                        type: 'POST',
                        data: {excelData: JSON.stringify(excelData)},
                        success: function(response) {
                    		    $(".loader").hide()
                            message("success", "Data Added Successfully")
                        },
                        error: function(xhr, status, error) {
                            message("error", "Error: "+status+" "+error);
                        }
                    });
                };

                reader.readAsArrayBuffer(file);
            });
        });
	</script>