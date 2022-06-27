<?php 

session_start();
// Redirect to login page if user is not logged in 
if (!isset($_SESSION['loggedin']) || ($_SESSION['usertype']!=='student')) {
	header('Location: index.php');
	exit;
}
require_once 'connection.php';
/* if session is created and user is logged in, continue 
    otherwise redirected to index.php */
if(isset($_GET['jID'])){
    $JobID = $_GET['jID'];
    $query1 = "SELECT * FROM job WHERE jobID='$JobID'";
    $result1 = $con->query($query1);
    $job = $result1->fetch_assoc();

    $JobType = $job['jobType'];
    $JobDescription = $job['jobDescription'];
    $JobProvince = $job['jobProvince'];
    $JobLocation = $job['jobLocation'];
    $JobProgram = $job['jobProgram'];
    $MinimumYear = $job['minimumYear'];
    $Verified = $job['verified'];
    $EmployerID = $job['employerID'];

    $query2 = "SELECT * FROM employer WHERE employerID='$EmployerID' ";
    $result2 = $con->query($query2);
    $employer = $result2->fetch_assoc();
    $EmployerName = $employer['employerName'];
    $EmployerDescription = $employer['employerDescription'];


}
else{
    header('location:students.php'); 
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
  	<button><a href="logout.php"><i></i>logout</a></button>

</div>
<!--End of Header -->

<!--Body -->
 <div class="body">
        <a href="logout.php"><i></i>logout</a>    
        <br>
        <br>

        <a href="deleteStudentProfile.php"><i></i>Delete your profile</a>  
        <br>
        <br>
        <?php
        echo "<h1>$JobType</h1>";
        echo "<p style=\"display:block\"> $JobDescription </p>"; 
        echo "<b><u>Program:</u></b> ".$JobProgram."<br>"; 
        echo "<b><u>Minimum Years:</u></b> ".$MinimumYear."<br>"; 
        echo "<b><u>Location:</u></b> ".$JobLocation.", ".$JobProvince."<br>";
        if($Verified == "YES")
            echo "<td> <p style=\"color:green;\"> Verified by your University! </p> </td>";
        else
            echo "<td> <p style=\"color:red;\"> Not verified by your University! </p> </td>";

        echo "<a href='job_apply.php?jID=$JobID'> <input type='button' value=\"Apply for the job\"> </a>";
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