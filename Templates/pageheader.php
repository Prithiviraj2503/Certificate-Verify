<div class="space-between">
  <div id="openNav">&#9776;</div>
  <div class="page-head">
 <?php if (isset($_SESSION["role"] )) {
    $pages = ['student_list.php' => 'Student List', 'course_list.php' => 'Course List', 'add_student.php' => 'Add Student', 'add_course.php' => 'Add Course', 'grade_list.php' => 'Grade List', 'add_grade.php' => 'Add Grade', 'add_staff.php' => 'Add Staff', 'staff_list.php' => 'Staff List', 'student_detail.php' => 'Student Detail', 'student_detail_front.php' => 'Student Detail', 'user_detail.php' => 'User Detail', 'bulk_upload_student.php' => 'Bulk Import', "access_setting.php" => 'Access Settings', "access_list.php" => "Role Access List"]; 
    echo $_SESSION["role"] . " > " . $pages[$currentPage]; ?>
  </div>
  <?php if($currentPage == 'student_list.php' && $_SESSION["role"] == "admin"){ ?>
    <div>
      <a href="add_student.php?mode=add">
      <button type="button" class="btn white" style="background: var(--primary-dark)">
        <i class="fa fa-plus"></i> Add Student
      </button>
    </a>
    <!-- <a href="add_student.php?mode=add">
      <button type="button" class="btn white" style="background: var(--primary-dark)">
        <i class="fa fa-cloud-download"></i> Export Data
      </button>
    </a> -->
    <select id="exportdata" class="btn" style="width: 45%;  color: white; background:var(--primary-dark)">
      <option value=""> Export Data</option>
      <option value="pdf">Export as Pdf</option>
      <option value="excel">Export as Excel</option>
    </select>
    </div>
  <?php }else if($currentPage == 'add_student.php'){ ?>
    <div>
    	<a href="student_list.php">
        <button type="button" class="btn white" style="background: var(--primary-dark)">
          <i class="fa fa-mail-forward"></i> Student List
        </button>
      </a>
      <a href="bulk_upload_student.php?mode=add">
        <button type="button" class="btn white" style="background: var(--primary-dark)">
          <i class="fa fa-cloud-upload"></i> Bulk Import
        </button>
      </a>
    </div>
  <?php }else if($currentPage == 'course_list.php'){ ?>
    <a href="add_course.php?mode=add">
      <button type="button" class="btn white" style="background: var(--primary-dark)">
        <i class="fa fa-plus"></i> Add Course
      </button>
    </a>
  <?php }else if($currentPage == 'add_course.php'){ ?>
    <a href="course_list.php">
      <button type="button" class="btn white" style="background: var(--primary-dark)">
        <i class="fa fa-mail-forward"></i> Course List
      </button>
    </a>
  <?php } else if($currentPage == 'grade_list.php'){ ?>
    <a href="add_grade.php?mode=add">
      <button type="button" class="btn white" style="background: var(--primary-dark)">
        <i class="fa fa-plus"></i> Add Grade
      </button>
    </a>
  <?php }else if($currentPage == 'add_grade.php'){ ?>
    <a href="grade_list.php">
      <button type="button" class="btn white" style="background: var(--primary-dark)">
        <i class="fa fa-mail-forward"></i> Grade List
      </button>
    </a>
  <?php } else if($currentPage == 'staff_list.php'){ ?>
    <a href="add_staff.php?mode=add">
      <button type="button" class="btn white" style="background: var(--primary-dark)">
        <i class="fa fa-plus"></i> Add Staff
      </button>
    </a>
  <?php } else if($currentPage == 'add_staff.php'){ ?>
    <a href="staff_list.php">
      <button type="button" class="btn white" style="background: var(--primary-dark)">
        <i class="fa fa-mail-forward"></i> Staff List
      </button>
    </a>
  <?php } else if($currentPage == 'access_setting.php'){ ?>
    <a href="access_list.php">
      <button type="button" class="btn white" style="background: var(--primary-dark)">
        <i class="fa fa-mail-forward"></i> Role Access List
      </button>
    </a>
  <?php } else if($currentPage == 'access_list.php'){ ?>
    <a href="access_setting.php?mode=add">
      <button type="button" class="btn white" style="background: var(--primary-dark)">
        <i class="fa fa-plus"></i> Add New Role
      </button>
    </a>
  <?php } ?>
</div>

<?php } ?>