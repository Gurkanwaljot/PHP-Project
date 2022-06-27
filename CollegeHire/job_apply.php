<?php

session_start();
// Redirect to login page if user is not logged in 
if (!isset($_SESSION['loggedin']) || ($_SESSION['usertype']!=='student')) {
	header('Location: index.php');
	exit;
}
require_once 'connection.php';

if(isset($_GET['jID'])){
    $JobID = $_GET['jID'];
    $studentID = $_SESSION['logged_studID'];
    $query1 = "SELECT * FROM appliedJob WHERE jobID=$JobID && studentID=$studentID";
    $result1 = $con->query($query1);
    if($result1->num_rows > 0){
        echo "You have already applied for this job!";
    }
    else{
        $query2 = "INSERT INTO appliedJob VALUES('$studentID','$JobID') ";
        if($con->query($query2) === FALSE)
            echo "Job application failed!";
        else
            echo "Job application successful!";
        
    }
}
header('Location: students.php');
?>