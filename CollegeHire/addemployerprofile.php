<?php
session_start();
require_once 'connection.php';

$DATABASE_TABLE="employer";

//get user id 
$Employer_userID = $_SESSION['userID'];

if (isset($_POST['EmployerDescription']) && isset($_POST['EmployerName'])) {
    
    $EmployerDescription = $_POST['EmployerDescription'];
    $EmployerName = $_POST['EmployerName'];
    
    echo $EmployerDescription;
    echo $EmployerName;

    $sql_add_query = "INSERT INTO $DATABASE_TABLE VALUES (null,'$EmployerName','$EmployerDescription','$Employer_userID')";

   // error_log("Records here: " . $sql_add_query);
    
    if ($con-> query($sql_add_query) === FALSE) {
        die("Could not add to the Employer");
    }
    else{
        
        header('Location: employerPage.php');

    }
}

?>