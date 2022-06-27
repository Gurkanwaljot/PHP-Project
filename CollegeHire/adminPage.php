<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

session_start();
// Redirect to login page if user is not logged in 
if (!isset($_SESSION['loggedin']) || ($_SESSION['usertype']!=='admin')) {
	header('Location: index.php');
	exit;
}
require_once 'connection.php';

$DATABASE_TABLE="job";

// SQL Prepping, prevents SQL injection.
$query = "SELECT * from $DATABASE_TABLE";
$stmt = $con->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

$total_jobs = $result->num_rows;
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
         
    
                        
        if($total_jobs==0){
          echo'<table width="220px" cellspacing ="0px" cellpadding ="0px" border="1px"> ';
                               
                   
              echo  '<tr>';
                   echo' <td height =40px width=40px bgcolor=#FFFFFF>No Jobs Added</td>';
               echo' </tr>';
				  
          echo '</table>';
        }
        
    ?>
    
   <?php
        if($total_jobs>0){
            echo'<table width="100%" cellspacing ="1px" cellpadding ="1px" border="1px"> ';

                        
                echo  '<thead>';
                    echo  '<tr>';
                        echo  '<th>ID</th>';
                        echo  '<th>Title</th>';
                        echo  '<th>Description</th>';
                        echo  '<th>Province</th>';
                        echo  '<th>Full Address</th>';
                        echo  '<th>Program</th>';
                        echo  '<th>Minimum Year</th>';
                        echo  '<th>Verified Status</th>';
                        echo  '<th>Delete Job</th>';
                        
                    echo  '</tr>';
                echo  ' </thead>';
                      
                      
               echo '<tbody>';
                    while($row = $result->fetch_assoc()) {
                        $verifiedbool = ($row["verified"]==0)? 'Unverified' :'Verified by Admin';
                        echo '<tr>';
                         echo '<td>'.$row["jobID"].'</td>'; 
                         echo '<td>'.$row["jobType"].'</td>'; 
                         echo '<td>'.$row["jobDescription"].'</td>'; 
                         echo '<td>'.$row["jobProvince"].'</td>'; 
                         echo '<td>'.$row["jobLocation"].'</td>'; 
                         echo '<td>'.$row["jobProgram"].'</td>'; 
                         echo '<td>'.$row["minimumYear"].'</td>'; 
                         if($verifiedbool=='Verified by Admin'){
                            echo '<td>'.$verifiedbool.'</td>';
                         }
                         else {
                            echo '<td><a href ="verifyJob.php?jobID='.$row["jobID"].'"><button>'.$verifiedbool.'</button></a></td>';

                         }
                         echo '<td><a  href ="adminDeleteJob.php?jobID='.$row["jobID"].'"><button>Delete</button></a></td>';

                        echo '</tr>';
                    }
                echo '</tbody>';

            echo '</table>';                    
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