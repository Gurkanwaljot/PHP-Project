<?php

require_once "connection.php"; // Using database connection file here	

//note that this ID is the student ID
if(isset($_GET['id'])){
    
  $studenttodelete =$_GET['id'];
  $useridtodelete =$SESSION['userID'];
  
  
  //delete all jobs in applied_jobs table with student
  $query = "DELETE FROM appliedJob WHERE studentID =?";
  $stmt = $con->prepare($query);
  $stmt->bind_param("i", $studenttodelete);
  $stmt->execute();
 
  
  //delete the student profile
  $query2 = "DELETE FROM students WHERE studentID =?";
  $stmt2 = $con->prepare($query2);
  $stmt2->bind_param("i", $studenttodelete);
  $stmt2->execute();
  
  
  //delete the student login
  $query3 = "DELETE FROM login WHERE userID = ?";
  $stmt3 = $con->prepare($query3);
  $stmt3->bind_param("i", $useridtodelete);
  $stmt3->execute();
  
  header('Location:logout.php');
}

?>