<?php
@session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<script>
let inputErr = false;
function validateRegisterFields() {
let allFieldsValid = true;
$("#registerform :input").each(function() {
if ($(this).is('input') || $(this).is('select')) {
        if ($(this).attr('id') === 'certfile' && $('#curfile').length) {
            return true; 
        }
        if ($(this).val() === '') {
            $(this).removeClass("inputsuccess").addClass("inputerror");
            allFieldsValid = false;
        } else {
            $(this).removeClass("inputerror").addClass("inputsuccess");
        }
    }
});

inputErr = !allFieldsValid;
}
</script>

    <?php if ($currentPage == 'add_grade.php'){ ?>
        <script>

        $("#addgradebtn").click(function(){
        validateRegisterFields()
        if(inputErr == false){
             let gradeData = {
                "grade":$("#grade").val(),
                "markrange":$("#markrange").val(),
                "status":$("#status").val(),
                "mode":$("#mode").val(),
               }
            $.ajax({
                url:"../Main/add_grade.php", 
                type: "post", 
                dataType: 'json',
                data: gradeData,
                beforeSend: function(){
                    $(".loader").show();
                },
                success: function(output){
                    $(".loader").hide();
                    if (output == 1){
                        if ($("#mode").val() == 'add'){
                            message("success", "Grade Added Successfully!")
                            reset()
                        }else{
                            message("success", "Grade Updated Successfully!")
                        }
                    }else{
                        message("error", output)
                    }
                },
                error:function(error){
                    $(".loader").hide();
                    message("error", error)
                }
            });

        }else{
           return false
        } 
    })
    </script>
    <?php } ?>


    <?php if ($currentPage == 'add_staff.php'){ ?>
        <script>

        $("#addstaffbtn").click(function(){
        validateRegisterFields()
        if(inputErr == false){
             let courseData = {
                "staffid":$("#staffid").val(),
                "staffname":$("#staffname").val(),
                "department":$("#department").val(),
                "mode":$("#mode").val(),
                "password":$("#password").val(),
                "email":$("#email").val(),
                "phone":$("#phone").val()
               }
            $.ajax({
                url:"../Main/add_staff.php", 
                type: "post", 
                dataType: 'json',
                data: courseData,
                beforeSend: function(){
                    $(".loader").show();
                },
                success: function(output){
                    $(".loader").hide();
                    if (output == 1){
                        if ($("#mode").val() == 'add'){
                            message("success", "Staff Added Successfully!")
                            reset()
                        }else{
                            message("success", "Staff Updated Successfully!")
                        }
                    }else{
                        message("error", output)
                    }
                },
                error:function(error){
                    $(".loader").hide();
                    message("error", error)
                }
            });

        }else{
           return false
        } 
    })
    </script>
    <?php } ?>

    <?php if ($currentPage == 'add_course.php'){ ?>
        <script>
        $("#course").change(function(){
        $.ajax({
            url:"../Main/get_course.php", 
            type: "post", 
            dataType: 'json',
            data: {"course":$("#course").val()},
            beforeSend: function(){
                $(".loader").show();
            },
            success: function(output){
                $(".loader").hide();
                $("#duration").val(output)
            },
            error:function(error){
                $(".loader").hide();
                message("error", error)
            }
        });
        })

        $("#addcoursebtn").click(function(){
        validateRegisterFields()
        if(inputErr == false){
             let courseData = {
                "courseid":$("#courseid").val(),
                "course":$("#coursev").val(),
                "duration":$("#duration").val(),
                "mode":$("#mode").val(),
                "description":$("#description").val(),
                "courseyear":$("#courseyear").val()
               }
            $.ajax({
                url:"../Main/add_course.php", 
                type: "post", 
                dataType: 'json',
                data: courseData,
                beforeSend: function(){
                    $(".loader").show();
                },
                success: function(output){
                    $(".loader").hide();
                    if (output == 1){
                        if ($("#mode").val() == 'add'){
                            message("success", "Course Added Successfully!")
                            reset()
                        }else{
                            message("success", "Course Updated Successfully!")
                        }
                    }else{
                        message("error", output)
                    }
                },
                error:function(error){
                    $(".loader").hide();
                    message("error", error)
                }
            });

        }else{
           return false
        } 
    })
    </script>
    <?php } ?>

    <?php if ($currentPage == 'add_student.php'){ ?>
    <script>
    $("#registerbtn").click(function(){
        validateRegisterFields()
        if(inputErr == false){
             let studentdata = {
                    "regnum":$("#regnum").val(),
                    "name":$("#name").val(),
                    "nic":$("#nic").val(),
                    "gender":$("#gender").val(),
                    "course":$("#course").val(),
                    "duration":$("#duration").val(),
                    "grade":$("#grade").val(),
                    "certnum":$("#certnum").val(),
                    "certdate":$("#certdate").val(),
                    "capdate":$("#capdate").val(),
                    "mode":$("#mode").val(),
                    "acyear":$("#acyear").val(),
                    "certfile": $("#certfile").prop('files')[0] 
                   }

            let formData = new FormData();
                for (let key in studentdata) {
                    formData.append(key, studentdata[key]);
                }

            $.ajax({
                url:"../Main/add_student.php", 
                type: "post", 
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $(".loader").show();
                },
                success: function(output){
                    $(".loader").hide();
                    if (output == 1){
                        if ($("#mode").val() == 'add'){
                            message("success", "Student Data Added Successfully!")
                            reset()
                        }else{
                            message("success", "Student Data Updated Successfully!")
                        }
                    }else{
                        message("error", output)
                    }
                },
                error:function(error){
                    $(".loader").hide();
                    message("error", error)
                }
            });

        }else{
           return false
        } 
    })

    </script>
    <?php } ?>


     <?php if ($currentPage == 'admin_login.php'){ ?>
    <script>
     $("#admin_login").click(function(){
        validateRegisterFields()
        if(inputErr == false){
             let adminData = {
                "adminid":$("#adminid").val(),
                "password":$("#password").val(),
               }

            $.ajax({
                url:"../Main/verify_admin.php", 
                type: "post", 
                dataType: 'json',
                data: adminData,
                beforeSend: function(){
                    $(".loader").show();
                },
                success: function(output){
                    $(".loader").hide();
                    if (output == 0){
                        message("error", "Incorrect User ID or Password")
                    }else{
                        location.href="student_list.php"
                    }
                },
                error:function(error){
                    $(".loader").hide();
                    message("error", error)
                }
            });

        }else{
           return false
        } 
    })
</script>
 <?php } ?>

   
 <?php if ($currentPage == 'student_detail_front.php'){ ?>
    <script>
    $("#getstudent_detail").click(function(){
        validateRegisterFields()
        if(inputErr == false){
             let studentdata = {
                "regnum":$("#regnum").val(),
                "nic":$("#nic").val(),
               }

            $.ajax({
                url:"../Main/get_student.php", 
                type: "post", 
                dataType: 'json',
                data: studentdata,
                beforeSend: function(){
                    $(".loader").show();
                },
                success: function(output){
                    $(".loader").hide();
                    if (output == 0){
                        message("error", "No record found for the provided Registration number and NIC")
                    }else if(output == 401){
                        message("error", "Oops! You are not authorized to access this record")
                    }else{
                        location.href = 'student_detail.php?regnum='+output.register_number

                    }
                },
                error:function(error){
                    $(".loader").hide();
                    message("error", error)
                }
            });

        }else{
           return false
        } 
    })
    $("#student_login").click(function(){
        validateRegisterFields()
        if(inputErr == false){
             let staffData = {
                "regnum":$("#regnum").val(),
                "nic":$("#nic").val(),
               }

            $.ajax({
                url:"../Main/verify_student.php", 
                type: "post", 
                dataType: 'json',
                data: staffData,
                beforeSend: function(){
                    $(".loader").show();
                },
                success: function(output){
                    $(".loader").hide();
                    if (output == 0){
                        message("error", "Incorrect Registration Number or NIC")
                    }else{
                        location.href = 'student_detail.php?regnum='+($("#regnum").val())
                    }
                },
                error:function(error){
                    $(".loader").hide();
                    message("error", error)
                }
            });

        }else{
           return false
        } 
    }) 
    </script>
<?php } ?>

<script>
    $('#certfile').on('change', function() {
      if ($(this).get(0).files.length > 0) {
        $('#curfile').hide(); 
      } 
    });
</script>


