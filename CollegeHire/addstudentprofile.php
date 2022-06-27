<?php
session_start();
require_once 'connection.php';

$DATABASE_TABLE="students";

//get user id 
$Student_userID = $_SESSION['userID'];

if (isset($_POST['stud_name']) && isset($_POST['stud_university']) 
        && isset($_POST['stud_program'])
        && isset($_POST['stud_schoolYear']) && isset($_POST['stud_province'])){
    
    $StudentName =$_POST['stud_name'];
    $University =$_POST['stud_university'];
    $Program = $_POST['stud_program'];
    $SchoolYear = $_POST['stud_schoolYear'];
    $Province = $_POST['stud_province'];
   

    $sql_add_query = "INSERT INTO $DATABASE_TABLE VALUES(null,'$Student_userID','$StudentName','$University',"
            . "'$Program','$SchoolYear','$Province')";

    echo $sql_add_query;
    if ($con-> query($sql_add_query) === FALSE) {
        die("Could not add Student");
    }
    else{
        
        header('Location: students.php');

    }
}
else{
    header('Location: studentPage.php');
}

?>