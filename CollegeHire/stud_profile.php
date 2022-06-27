<?php

session_start();
// Redirect to login page if user is not logged in 
if (!isset($_SESSION['loggedin']) || ($_SESSION['usertype']!=='student')) {
	header('Location: index.php');
	exit;
}
require_once 'connection.php';
/* if session is created and user is logged in, continue, 
    otherwise redirected to index.php */

$userID = $_SESSION['userID'];
$query1 = "SELECT * FROM students WHERE userID=$userID";
$result1 = $con->query($query1);
$stud = $result1->fetch_assoc();
/* $stud is an array with all the rows from 'students' table, where userID matched $userID value (logged in student's userID) */ 
    
$stud_id = $stud['studentID'];     //student's student ID
$stud_name = $stud['name'];     
$stud_university = $stud['university'];     
$stud_program = $stud['program'];      
$stud_schoolYear = $stud['schoolYear'];     
$stud_province = $stud['province'];      


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

	<title>College Hire </title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

    
<!--Header -->
<div class="header">
    <br>
  	<h1>College Hire</h1>
  	<br>
  	<a href="logout.php"><i></i>LOGOUT</a>
        <a href="deleteStudentProfile.php?id=<?php echo $stud_id ?>"><i></i>DELETE PROFILE</a>
        <a href="students.php"><i></i>RETURN TO HOMEPAGE</a>

</div>
<!--End of Header -->

<!--Body -->
 <div class="body">

    

        
        <h1>Student details:</h1>
        <p style="color:green">The below student details are in <b><u>READ ONLY</u></b> mode.</p>
        Student Name: 
        <input type="text" name="stud_name" value="<?php echo $stud_name ?>" readonly><br>
        University:
        <input type="text" name="stud_university" value="<?php echo $stud_university ?>" readonly><br>
        Program:
        <input type="text" name="stud_program" value="<?php echo $stud_program ?>" readonly><br>
        School Year:
        <input type="text" name="stud_schoolYear" value="<?php echo $stud_schoolYear ?>" readonly><br>
        Province:
        <input type="text" name="stud_province" value="<?php echo $stud_province ?>" readonly><br>
        <br>
        <a href="stud_prof_update.php"><input type="button" value="Update Profile"></a>

</div>
<!--End of Body -->
 
 <!--Footer -->
 <div class="footer">
  <p>@CollegeHire2021</p>
</div>
  <!-- End of Footer -->
 </body>
</html>