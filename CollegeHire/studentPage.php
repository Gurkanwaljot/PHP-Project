<?php
session_start();
// Redirect to login page if user is not logged in 
if (!isset($_SESSION['loggedin']) || ($_SESSION['usertype']!=='student')) {
	header('Location: index.php');
	exit;
}
require_once 'connection.php';

$DATABASE_TABLE="students";
$Student_userID = $_SESSION['userID'];

//check if student with user ID already has an existing profile
$query= "SELECT * from $DATABASE_TABLE WHERE userID = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i",$Student_userID);
$stmt->execute();
$result = $stmt->get_result();

$total_student_profiles = $result->num_rows;


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

</div>
<!--End of Header -->

<!--Body -->
 <div class="body">

    
    <?php
    
      if($total_student_profiles<1){
    ?>
        <form action ="addstudentprofile.php" method="POST">
      
           <table >
           <tr>
               <th>Student Name</th>
               <td><input type="text" size="30" name="stud_name"></td>
           </tr>
           <tr>
               <th>Student University</th>
               <td><input type="text" size="30" name="stud_university"></td>
           </tr>
           <tr>
               <th>Student Program </th>
               <td>
               <label for="stud_program"></label>
                <select name="stud_program" id="stud_program">
                    <option value="none"> choose a job program </option>
                    <option value="General"> General</option>
                    <option value="Science"> Science </option>
                    <option value="Applied Science"> Applied Science </option>
                    <option value="Law"> Law </option>
                    <option value="Psychology"> Psychology </option>
                    <option value="HR"> HR </option>
                </select>
               </td>
           </tr>
           <tr>
               <th>School Year </th>
               <td>
               <label for="stud_schoolYear"></label>
                <select name="stud_schoolYear" id="stud_schoolYear">
                    <option value="none"> choose your study year </option>
                    <option value="1st"> 1st</option>
                    <option value="2nd"> 2nd </option>
                    <option value="3rd"> 3rd </option>
                    <option value="4th/LastYear"> 4th/LastYear </option>
                </select>
               </td>
           </tr>
           <tr>
               <th>Student Province </th>
               <td>
               <label for="stud_province"></label>
                <select name="stud_province" id="stud_province">
                    <option value="none"> choose your province </option>
                    <option value="BC"> BC</option>
                    <option value="AB"> AB </option>
                    <option value="NB"> NB </option>
                </select>
               </td>
           </tr>
           </table>
           <br>
           <input type='submit' name='submit' value='Add Profile'>
       </form> 
      
      
        <?php
        }else{
                 header('location:students.php'); 
        }
        
        ?>
  	 </div>
<!--End of Body -->
 
 <!--Footer -->
 <div class="footer">
  <p>@CollegeHire2021</p>
</div>
  <!-- End of Footer -->
</body>
</html>