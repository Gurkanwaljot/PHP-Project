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


if(isset($_GET['jobID'])){
    
  $jobtodelete =$_GET['jobID'];
  
   //delete all jobs in applied_jobs table with student
  $query = "DELETE FROM appliedJob WHERE jobID =?";
  $stmt = $con->prepare($query);
  $stmt->bind_param("i", $jobtodelete);
  $stmt->execute();
  
  
  //delete job
  $query = "DELETE FROM $DATABASE_TABLE WHERE jobID =?";
  $stmt = $con->prepare($query);
  $stmt->bind_param("i", $jobtodelete);
  $stmt->execute();
  
  header('Location:adminPage.php');
}

?>