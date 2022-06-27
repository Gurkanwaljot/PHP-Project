<?php
session_start();
require_once "connection.php"; // Using database connection file here	

//note that this ID is the employer ID
if(isset($_GET['id'])){
    
  $employertodelete =$_GET['id'];
  $useridtodelete =$_SESSION['userID'];
  
  
  //delete all jobs in applied_jobs table with employer
  $query = "DELETE FROM appliedJob WHERE jobID in (select jobID from job where employerID =?)";
  $stmt = $con->prepare($query);
  $stmt->bind_param("i", $employertodelete);
  $stmt->execute();
  
  //delete all employers jobs
  $query2 = "DELETE FROM job WHERE employerID = ?";
  $stmt2 = $con->prepare($query2);
  $stmt2->bind_param("i", $employertodelete);
  $stmt2->execute();

  
  //delete the employer 
  $query3 = "DELETE FROM employer WHERE employerID = ?";
  $stmt3 = $con->prepare($query3);
  $stmt3->bind_param("i", $employertodelete);
  $stmt3->execute();
  
  
  //delete the employer login
  $query3 = "DELETE FROM login WHERE userID = ?";
  $stmt3 = $con->prepare($query3);
  $stmt3->bind_param("i", $useridtodelete);
  $stmt3->execute();
  
  header('Location:logout.php');
}

?>