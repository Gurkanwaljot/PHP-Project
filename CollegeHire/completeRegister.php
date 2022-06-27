<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

session_start();
require_once 'connection.php';

$DATABASE_TABLE="login";

function sanitizeString($var)
        {
                $var =stripslashes($var);
                $var =htmlentities($var);
                $var =strip_tags($var);
                return $var;
        }


if ( !isset($_POST['username'], $_POST['password']) ) {
  
     exit('Please fill both the username and password fields!');
}

if(isset($_POST['username'])){
    
     $username= sanitizeString($_POST['username']);
}
$password=$_POST['password'];
$usertype =$_POST['usertype'];

// SQL Prepping, prevents SQL injection.
if ($stmt = $con->prepare("SELECT username,password FROM $DATABASE_TABLE WHERE username = ?")) {
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		echo "User exists, please login!";
                 header('Location:index.php');

	} else {

            if ($stmt = $con->prepare("INSERT INTO $DATABASE_TABLE VALUES (null,?, ?, ?)")) {
                $stmt->bind_param("sss", $usertype, $username, $password);
                $stmt->execute();
                echo "You have successfully registered the account!";
                    header('Location:index.php');
                
            } else {
                echo "Could not prepare statement!";
                header('Location: index.php');
            }
	}
	$stmt->close();
} else {
	echo "Could not prepare statement!";
        header('Location: index.php');
} 

$con->close();
?>

