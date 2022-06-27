<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

/* Verify Job 
 * Get Job ID 
 * Update field verified == true 
 * save to DB
 */

session_start();
require_once "connection.php";

$DATABASE_TABLE = "job";

$jobToVerify=$_GET["jobID"];

// SQL Prepping, prevents SQL injection.
if ($stmt = $con->prepare("SELECT verified FROM $DATABASE_TABLE WHERE jobID = ?")) {
	$stmt->bind_param("i",$jobToVerify);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows < 0) {
		echo "Job ID does not exist!";
		header('Location:adminPage.php');
	} else {

            if ($stmt = $con->prepare("UPDATE $DATABASE_TABLE SET verified = 1 WHERE jobID = ?")) {
                $stmt->bind_param("i",$jobToVerify);
                $stmt->execute();
                echo "You have successfully verified the job";
		header('Location:adminPage.php');
                
            } else {
                echo "Could not prepare statement here!";
            }
	}
	$stmt->close();
} else {
	echo "Could not prepare statement!";
	header('Location:adminPage.php');
} 
$con->close();
?>
