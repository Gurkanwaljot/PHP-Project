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

if( isset($_POST['stud_name']) && isset($_POST['stud_university']) && isset($_POST['stud_program']) && isset($_POST['stud_schoolYear']) && isset($_POST['stud_province']) ){
    $s_name = $_POST['stud_name'];     
    $s_university = $_POST['stud_university'];     
    $s_program = $_POST['stud_program'];     
    $s_schoolYear = $_POST['stud_schoolYear'];     
    $s_province = $_POST['stud_province'];  

    $query2 = "UPDATE students SET `name`='$s_name' , `university`='$s_university' , `program`='$s_program' , `schoolYear`='$s_schoolYear' , `province`='$s_province' WHERE `studentID`='$stud_id' ";
    if($con->query($query2) === FALSE) 
        die (" Could not update the details!");
    
    header('location:stud_profile.php');
}


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
         <a href="students.php"><i></i>RETURN TO HOMEPAGE</a>

</div>
<!--End of Header -->

<!--Body -->
 <div class="body">


        <h4>Student details:</h4>
        <p style="color:red">The below student details are in <b><u>EDIT</u></b> mode. All the fields are required. Save changes carefully.</p>
        <form method="POST" action="">
            Student Name: 
            <input type="text" name="stud_name" value="<?php echo $stud_name ?>" Required><br>
            University:
            <input type="text" name="stud_university" value="<?php echo $stud_university ?>" Required><br>
            Program:
            <input type="text" name="stud_program" value="<?php echo $stud_program ?>" Required><br>
            School Year:
            <input type="text" name="stud_schoolYear" value="<?php echo $stud_schoolYear ?>" Required><br>
            Province:
            <input type="text" name="stud_province" value="<?php echo $stud_province ?>" Required><br>
            <br>
            <input type="submit" value="Save Changes">
          
        </form>
 </div>
<!--End of Body -->
 
 <!--Footer -->
 <div class="footer">
  <p>@CollegeHire2021</p>
</div>
  <!-- End of Footer -->
</body>
</html>