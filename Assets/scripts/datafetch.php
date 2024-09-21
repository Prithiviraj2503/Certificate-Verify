<?php
@session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<script type="text/javascript">
    let role = "<?php echo isset($_SESSION['role']) ? $_SESSION['role'] : ''; ?>";
    if ($("#searchinput").length > 0) {
        $("#searchinput").change(function(){
            let search = $("#searchinput").val();
            updatestudent(search);
        });
    }
    function escapeHtml(text) {
        return text.replace(/&/g, "&amp;")
               .replace(/</g, "&lt;")
               .replace(/>/g, "&gt;")
               .replace(/"/g, "&quot;")
               .replace(/'/g, "&#039;");
    }
</script>
<?php if ($currentPage == 'student_list.php'){ ?>
<script>
function action(mode, regnum){
    if (mode == 'view'){
        location.href = 'student_detail.php?regnum=' + regnum;
    } else if (mode == 'edit'){
        location.href = 'add_student_page.php?mode=edit&regnum=' + regnum;
    } else if (mode == 'delete'){
        let message = "Are you sure you want to delete the student data with register number: " + regnum;
        let isdel = confirm(message);
        if (isdel){
            $.ajax({
                url: "../Main/delete_student_data.php",
                type: "post",
                dataType: 'json',
                data: {"regnum": regnum},
                beforeSend: function(){
                    $(".loader").show();
                },
                success: function(output){
                    if (output == 1){
                        let searchVal = $("#searchinput").val() || '';
                        updatestudent(searchVal);
                    } else {
                        alert("Unable to delete the data. Kindly try again.");
                    }
                    $(".loader").hide();
                },
                error: function(){
                    alert("Unable to delete the data. Kindly try again.");
                    $(".loader").hide();
                }
            });
        } else {
            return false;
        }
    }
}
function updatestudent(search){
    $.ajax({
        url: "../Main/getall_student_data.php",
        type: "post",
        dataType: 'json',
        data: {"search": search},
        beforeSend: function(){
            $(".loader").show();
        },
        success: function(output){
            $(".loader").hide();
            if (output == 401){
                alert("Oops! You are not authorized to access this record.");
                return;
            }
            let totalrec = output.length;
            let appenddata = '';
            let actions = '';
            if (totalrec > 0){
                for(let i = 0; i < totalrec; i++){
                    if (role == 'admin') {
                        actions = `
                            <div>
                                <button title="View" type="button" style="background:blue" class="btn btn-eye" onclick="action('view', '` + escapeHtml(output[i]["register_number"]) + `')">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button title="Edit" type="button" style="background:green" class="btn btn-info" onclick="action('edit', '` + escapeHtml(output[i]["register_number"]) + `')">
                                    <i class="fa fa-pencil-square-o"></i>
                                </button>
                                <button title="Delete" type="button" style="background:tomato" class="btn btn-danger" onclick="action('delete', '` + escapeHtml(output[i]["register_number"]) + `')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>`;
                    } else {
                        actions = `
                            <div>
                                <button type="button" style="background:blue" class="btn btn-eye" onclick="action('view', '` + escapeHtml(output[i]["register_number"]) + `')">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>`;
                    }

                    appenddata += `<tr>
                    <td>`+(i+1)+`</td>
                    <td>`+escapeHtml(output[i]["register_number"])+`</td>
                    <td>`+escapeHtml(output[i]["student_name"])+`</td>
                    <td>`+escapeHtml(output[i]["course"])+`</td>
                    <td>`+escapeHtml(output[i]["final_grade"])+`</td>
                    <td>`+actions+`</td>
                    </tr>`;
                }
            } else {
                appenddata = '<tr><td style="color:black;text-align:center" colspan="7">No Records Found!</td></tr>';
            }
            $("#total").html("Total Students : " + totalrec);
            $("#studentlist").html(appenddata);
        },
        error: function(error){
            $(".loader").hide();
            alert("Error: " + error.responseText);
        }
    });
}

updatestudent('');
</script>
<?php } ?>

<!-- Course List -->

<?php if ($currentPage == 'course_list.php'){ ?>
<script>
function courseaction(mode, courseid) {
    if (mode == 'edit') {
        location.href = 'add_course.php?mode=edit&courseid=' + courseid;
    } else if (mode == 'delete') {
        let message = "Are you sure you want to delete the course data with course ID: " + courseid;
        let isdel = confirm(message);
        if (isdel) {
            $.ajax({
                url: "../Main/delete_course_data.php",
                type: "post",
                dataType: 'json',
                data: {"courseid": courseid},
                beforeSend: function() {
                    $(".loader").show();
                },
                success: function(output) {
                    if (output == 1) {
                        let searchVal = $("#searchinput").val() || '';
                        updatecourse(searchVal);
                    } else {
                        alert("Unable to delete the data. Kindly try again.");
                    }
                    $(".loader").hide();
                },
                error: function() {
                    alert("Unable to delete the data. Kindly try again.");
                    $(".loader").hide();
                }
            });
        } else {
            return false;
        }
    }
}
function updatecourse(search) {
    $.ajax({
        url: "../Main/getall_course_data.php",
        type: "post",
        dataType: 'json',
        data: {"search": search},
        beforeSend: function() {
            $(".loader").show();
        },
        success: function(output) {
            $(".loader").hide();
            if (output == 401) {
                alert("Oops! You are not authorized to access this record.");
                return;
            }
            let totalrec = output.length;
            let appenddata = '';
            let actions = '';
            if (totalrec > 0) {
                for (let i = 0; i < totalrec; i++) {
                    if (role == 'admin') {
                        actions = `
                            <div>
                                <button type="button" title="Edit" style="background:green" class="btn btn-info" onclick="courseaction('edit', '` + escapeHtml(output[i]["courseid"]) + `')">
                                    <i class="fa fa-pencil-square-o"></i>
                                </button>
                                <button type="button" title="Delete" style="background:tomato" class="btn btn-danger" onclick="courseaction('delete', '` + escapeHtml(output[i]["courseid"]) + `')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>`;
                    }
                    
                    appenddata += `<tr>
                        <td>` + (i+1) + `</td>
                        <td>` + escapeHtml(output[i]["courseid"]) + `</td>
                        <td>` + escapeHtml(output[i]["course"]) + `</td>
                        <td>` + escapeHtml(output[i]["courseyear"]) + `</td>
                        <td>` + escapeHtml(output[i]["duration"]) + `</td>
                        <td>` + actions + `</td>
                    </tr>`;
                }
            } else {
                appenddata = '<tr><td style="color:black;text-align:center" colspan="6">No Records Found!</td></tr>';
            }
            $("#totalcourse").html("Total Course(s): " + totalrec);
            $("#courselist").html(appenddata);
        },
        error: function(error) {
            $(".loader").hide();
            alert("Error: " + error.responseText);
        }
    });
}

// Initial load
updatecourse('');

</script>
<?php } ?>

<!-- Grade List -->

<?php if ($currentPage == 'grade_list.php'){ ?>
<script>
function gradeaction(mode, grade) {
    if (mode == 'edit') {
        location.href = 'add_grade.php?mode=edit&grade=' + grade;
    } else if (mode == 'delete') {
        let message = "Are you sure you want to delete the grade data with grade ID: " + grade;
        let isdel = confirm(message);
        if (isdel) {
            $.ajax({
                url: "../Main/delete_grade_data.php",
                type: "post",
                dataType: 'json',
                data: {"grade": grade},
                beforeSend: function() {
                    $(".loader").show();
                },
                success: function(output) {
                    if (output == 1) {
                        let searchVal = $("#searchinput").val() || '';
                        updategrade(searchVal);
                    } else {
                        alert("Unable to delete the data. Kindly try again.");
                    }
                    $(".loader").hide();
                },
                error: function() {
                    alert("Unable to delete the data. Kindly try again.");
                    $(".loader").hide();
                }
            });
        } else {
            return false;
        }
    }
}
function updategrade(search) {
    $.ajax({
        url: "../Main/getall_grade_data.php",
        type: "post",
        dataType: 'json',
        data: {"search": search},
        beforeSend: function() {
            $(".loader").show();
        },
        success: function(output) {
            $(".loader").hide();
            if (output == 401) {
                alert("Oops! You are not authorized to access this record.");
                return;
            }
            let totalrec = output.length;
            let appenddata = '';
            let actions = '';
            if (totalrec > 0) {
                for (let i = 0; i < totalrec; i++) {
                    if (role == 'admin') {
                        actions = `
                            <div>
                                <button type="button" title="Edit" style="background:green" class="btn btn-info" onclick="gradeaction('edit', '` + escapeHtml(output[i]["grade"]) + `')">
                                    <i class="fa fa-pencil-square-o"></i>
                                </button>
                                <button type="button" title="Delete" style="background:tomato" class="btn btn-danger" onclick="gradeaction('delete', '` + escapeHtml(output[i]["grade"]) + `')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>`;
                    }
                    
                    appenddata += `<tr>
                        <td>` + (i+1) + `</td>
                        <td>` + escapeHtml(output[i]["grade"]) + `</td>
                        <td>` + escapeHtml(output[i]["markrange"]) + `</td>
                        <td>` + escapeHtml(output[i]["status"]) + `</td>
                        <td>` + actions + `</td>
                    </tr>`;
                }
            } else {
                appenddata = '<tr><td style="color:black;text-align:center" colspan="6">No Records Found!</td></tr>';
            }
            $("#totalgrade").html("Total Grade(s): " + totalrec);
            $("#gradelist").html(appenddata);
        },
        error: function(error) {
            $(".loader").hide();
            alert("Error: " + error.responseText);
        }
    });
}

// Initial load
updategrade('');

</script>
<?php } ?>


<!-- Staff List -->
<?php if ($currentPage == 'staff_list.php'){ ?>
<script>
function staffaction(mode, staffid) {
    if (mode == 'edit') {
        location.href = 'add_staff.php?mode=edit&staffid=' + staffid;
    } else if (mode == 'delete') {
        let message = "Are you sure you want to delete the staff data with staff ID: " + staffid;
        let isdel = confirm(message);
        if (isdel) {
            $.ajax({
                url: "../Main/delete_staff_data.php",
                type: "post",
                dataType: 'json',
                data: {"staffid": staffid},
                beforeSend: function() {
                    $(".loader").show();
                },
                success: function(output) {
                    if (output == 1) {
                        let searchVal = $("#searchinput").val() || '';
                        updatestaff(searchVal);
                    } else {
                        alert("Unable to delete the data. Kindly try again.");
                    }
                    $(".loader").hide();
                },
                error: function() {
                    alert("Unable to delete the data. Kindly try again.");
                    $(".loader").hide();
                }
            });
        } else {
            return false;
        }
    }
}
function updatestaff(search) {
    $.ajax({
        url: "../Main/getall_staff_data.php",
        type: "post",
        dataType: 'json',
        data: {"search": search},
        beforeSend: function() {
            $(".loader").show();
        },
        success: function(output) {
            $(".loader").hide();
            if (output == 401) {
                alert("Oops! You are not authorized to access this record.");
                return;
            }
            let totalrec = output.length;
            let appenddata = '';
            let actions = '';
            if (totalrec > 0) {
                for (let i = 0; i < totalrec; i++) {
                    if (role == 'admin') {
                        actions = `
                            <div>
                                <button type="button" title="Edit" style="background:green" class="btn btn-info" onclick="staffaction('edit', '` + escapeHtml(output[i]["staffid"]) + `')">
                                    <i class="fa fa-pencil-square-o"></i>
                                </button>
                                <button type="button" title="Delete" style="background:tomato" class="btn btn-danger" onclick="staffaction('delete', '` + escapeHtml(output[i]["staffid"]) + `')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>`;
                    }
                    
                    appenddata += `<tr>
                        <td>` + (i+1) + `</td>
                        <td>` + escapeHtml(output[i]["staffid"]) + `</td>
                        <td>` + escapeHtml(output[i]["staffname"]) + `</td>
                        <td>` + escapeHtml(output[i]["department"]) + `</td>
                        <td>` + escapeHtml(output[i]["email"]) + `</td>
                        <td>` + escapeHtml(output[i]["phone"]) + `</td>
                        <td>` + actions + `</td>
                    </tr>`;
                }
            } else {
                appenddata = '<tr><td style="color:black;text-align:center" colspan="6">No Records Found!</td></tr>';
            }
            $("#totalstaff").html("Total Staff(s): " + totalrec);
            $("#stafflist").html(appenddata);
        },
        error: function(error) {
            $(".loader").hide();
            alert("Error: " + error.responseText);
        }
    });
}

// Initial load
updatestaff('');

</script>
<?php } ?>