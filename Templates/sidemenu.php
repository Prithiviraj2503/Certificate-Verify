<?php
@session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<div id="mySidenav" class="sidenav">
<h4 class="sidelogo">Inst Name</h4>
<div class="white" style="margin-bottom: 20px">
    <span><i class="fa fa-user"></i> Hello, <?php echo $_SESSION["username"]; ?>!</span>
    <span><i class="fa fa-calendar"></i> <?php echo date('d:m:Y'); ?></span>
</div>
<span href="javascript:void(0)" class="closebtn" id="closeNav">&times;</span>
<?php if ($_SESSION["role"] == 'admin'){ ?>
<a href="student_list.php" class="<?php echo ($currentPage == 'student_list.php') ? 'active' : ''; ?>"><i class="fa fa-users"></i> Manage Students</a>
<a href="student_detail_front.php" class="<?php echo ($currentPage == 'student_detail_front.php') ? 'active' : ''; ?>"><i class="fa fa fa-male"></i> Student Detail</a>
<!-- <a href="add_student.php?mode=add" class="<?php // echo ($currentPage == 'add_student.php') ? 'active' : ''; ?>"><i class="fa fa-plus-circle"></i> New Student</a> -->
<a href="course_list.php" class="<?php echo ($currentPage == 'course_list.php') ? 'active' : ''; ?>"><i class="fa fa-book"></i> Manage Course</a>
<a href="grade_list.php" class="<?php echo ($currentPage == 'grade_list.php') ? 'active' : ''; ?>"><i class="fa fa-bookmark"></i> Manage Grades</a>
<a href="staff_list.php" class="<?php echo ($currentPage == 'staff_list.php') ? 'active' : ''; ?>"><i class="fa fa-user"></i> Manage Staff</a>
<!-- <a href="add_course.php?mode=add" class="<?php //echo ($currentPage == 'add_course.php') ? 'active' : ''; ?>"><i class="fa fa-book"></i> Add Course</a> -->
<?php }else if ($_SESSION["role"] == 'staff') { ?>
<a href="student_list.php" class="<?php echo ($currentPage == 'student_list.php') ? 'active' : ''; ?>"><i class="fa fa-users"></i> Manage Students</a>
    <a href="student_detail_front.php" class="<?php echo ($currentPage == 'student_detail_front.php') ? 'active' : ''; ?>"><i class="fa fa-user"></i> Student Detail</a>
<?php } ?>
<a style="border-top:1px solid silver;margin-top: 50px" href="logout.php" class="logout"><i class="fa fa-power-off	
"></i> Logout</a>
</div>