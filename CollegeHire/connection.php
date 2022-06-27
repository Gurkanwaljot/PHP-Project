<?php

$DATABASE_HOST = "localhost";
$DATABASE_USER = "theuser";
$DATABASE_PASS = "user4321123/";
$DATABASE_NAME = "jobPortal";


$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_error()){
    echo "Failed to connect to MySQL:  ".mysqli_connect_error();
}

?>