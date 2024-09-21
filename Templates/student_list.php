<?php 
@session_start(); 
if (!isset($_SESSION["role"])) {
    header("Location: index.php");
    exit;
}
include 'header.php';
if ($_SESSION["role"] == "admin" || $_SESSION["role"] == "staff") {  
  include 'title.php';
  include 'sidemenu.php';
}
?>
<div id="mainContent" class="main">
  <?php include "pageheader.php"; ?>
  <div class="custcontainer">
    <div class="loader"></div>
      <div class="authfield box" style="width: 99%">
      	<div class="alert hide" id="message"></div>
        <div class="space-between">
              <h5 id="total">Total Students : 0</h5>
              <input type="text" id="searchinput" class="input-field" placeholder="&#128269; Search Student" style="width: 25%; padding: 5px">
          </div>

          <table id="example" class="table table-bordered" style="width:100%;">
            <thead class="white" style="background: var(--primary-dark)">
                <tr>
                    <th>S. No</th>
                    <th>Register Number</th>
                    <th>Student Name</th>
                    <th>Course</th>
                    <th>Grade</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="studentlist">
               	
            </tbody>
        </table>
    </div>

      </div>
  </div>
</div>
<?php include 'footer.php' ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.20/jspdf.plugin.autotable.min.js"></script>


<script type="text/javascript">
      $('#exportdata').change( function() {
        
        const selectedValue = $(this).val();

          $.ajax({
                  url: '../Main/getall_student_data.php',
                  method: 'POST',
                  data:{"search":""},
                  dataType: 'json',
                  beforeSend: function(){
                    $(".loader").show();
                  },
                  success: function(data) {
                    $(".loader").hide();
                      if (selectedValue == 'pdf') {
                          generatePDF(data);
                        }else if (selectedValue == 'excel'){
                          generateExcel(data)
                        }
                  },
                  error: function(xhr, status, error) {
                    $(".loader").show();
                      console.error("Error fetching data:", error);
                  }
              });

            });


       function generatePDF(data) {
          const { jsPDF } = window.jspdf;
          const doc = new jsPDF();

          // Define columns and data for the table
          const columns = [
              { header: "Reg. No", dataKey: "register_number" },
              { header: "Student Name", dataKey: "student_name" },
              { header: "NIC", dataKey: "nic" },
              { header: "Gender", dataKey: "gender" },
              { header: "Course", dataKey: "course" },
              { header: "Duration", dataKey: "duration" },
              { header: "Grade", dataKey: "final_grade" },
              { header: "Academic Year", dataKey: "acyear" },
              { header: "Certificate", dataKey: "certificate" },
              { header: "Cert. Issue Date", dataKey: "certificate_issue_date" },
              { header: "Cert. Date", dataKey: "certificate_number" }
          ];

          // Add title
          doc.setFontSize(18);
          doc.text("Student Data", 14, 20);

          // Add table
            doc.autoTable({
                head: [columns.map(col => col.header)],
                body: data.map(student => columns.map(col => student[col.dataKey])),
                startY: 30,
                theme: 'grid',
                margin: { horizontal: 10 },
                styles: {
                    cellPadding: 2,
                    fontSize: 8, // Adjust font size here
                    valign: 'middle',
                    halign: 'left'
                },
                headStyles: {
                    fontSize: 10, // Font size for header
                    fillColor: [36, 38, 93],
                    textColor: [255, 255, 255],
                    lineWidth: 0.5,
                    lineColor: [36, 38, 93],
                },
                footStyles: {
                    fontSize: 8, // Font size for footer (if any)
                }
            });

          // Save the PDF
          doc.save("students_data.pdf");
      }

    function generateExcel(data) {
        const ws = XLSX.utils.json_to_sheet(data);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Students");

        XLSX.writeFile(wb, "students_data.xlsx");
    }
</script>