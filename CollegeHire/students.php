<?php

session_start();
// Redirect to login page if user is not logged in 
if (!isset($_SESSION['loggedin']) || ($_SESSION['usertype']!=='student')) {
	header('Location: index.php');
	exit;
}
require_once 'connection.php';
/* if session is created and user is logged in, continue, 
    otherwise redirected to index.php */

$userID = $_SESSION['userID'];
$query1 = "SELECT * FROM students WHERE userID=$userID";
$result1 = $con->query($query1);
$stud = $result1->fetch_assoc();
/* $stud is an array with all the rows from 'students' table, where userID matched $userID value (logged in student's userID) */ 

$stud_name = $stud['name'];     //student's name
$_SESSION['logged_studName']=$stud_name;
$stud_id = $stud['studentID'];     //student's student ID
$_SESSION['logged_studID']=$stud_id;

echo "Welcome "."$stud_name".".";   //welcome message

$query2 = "SELECT * FROM job where jobProvince =? and jobProgram = ? ";
$stmt2 = $con->prepare($query2);
$stmt2->bind_param("ss", $stud['province'],$stud['program']);
$stmt2->execute();
$result2 = $stmt2->get_result();

$avljobs = $result2->num_rows;

$query3 = "SELECT * FROM appliedJob WHERE studentID=$stud_id";
$result3 = $con->query($query3);
$appjobs = $result3->num_rows;

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
        <form method="GET">
        <a href="stud_profile.php"><input type="button" value="View Profile"></a>
        <br><br>

        <?php

        //Displaying all the available jobs (if any)
        echo "<h3>Available Jobs:</h3>";

        if ($avljobs > 0) {
            echo "<table border=\"1px\">";
            echo "<tr>";
            echo "<th>Job Title</th>";
            echo "<th>JOb Province</th>";
            echo "<th>Job Program</th>";
            echo "<th>MinimumYear</th>";
            echo "<th>Verified</th>";
            echo "<th></th>";
            echo "</tr>";   //title row

            for ($j = 0; $j < $avljobs; $j++) {
                $fetch_row = $result2->fetch_assoc();

                $JobID = $fetch_row['jobID'];
                $JobType = $fetch_row['jobType'];
                $JobProvince = $fetch_row['jobProvince'];
                $JobProgram = $fetch_row['jobProgram'];
                $MinimumYear = $fetch_row['minimumYear'];
                $Verified = $fetch_row['verified'];

                echo '<tr>';
                echo   '<td>' . $JobType . '</td>';
                echo   '<td>' . $JobProvince . '</td>';
                echo   '<td>' . $JobProgram . '</td>';
                echo   '<td>' . $MinimumYear . '</td>';
                if($Verified == "YES")
                    echo "<td> <p style=\"color:green;\"> YES </p> </td>";
                else
                    echo "<td> <p style=\"color:red;\"> NO </p> </td>";
                // each job's overview in every row
                echo    "<td><a href ='job_desc.php?jID=$JobID'> <input type=\"button\" value=\"Expand\"> </a></td>";
                // linked button to view full information about the job in job_desc.php 
                // also can apply job in job_desc.php page
                echo   '</tr>';

                echo "</table>";
            }
        } 
        else{
            echo "No Job available yet! ";
        }

        //Now displaying all the applied for jobs (if any)
        echo "<h3>Applied for Jobs:</h3>";

        if ($appjobs > 0) {
            echo "<table border=\"1px\">";
            echo "<tr>";
            echo "<th>Job Title</th>";
            echo "<th>JOb Province</th>";
            echo "<th>Job Program</th>";
            echo "<th>MinimumYear</th>";
            echo "<th>Verified</th>";
            echo "<th></th>";
            echo "</tr>";   //title row

            for ($j = 0; $j < $appjobs; $j++) {
                $fetch_job = $result3->fetch_assoc();
                // one applied job per iteration
                $JobID = $fetch_row['jobID'];

                $query4 = "SELECT * FROM job WHERE jobID=$JobID";
                $result4 = $con->query($query4);
                // only one job for one jobID in jobTable
                $fetch_row = $result4->fetch_assoc();

                $JobType = $fetch_row['jobType'];
                $JobProvince = $fetch_row['jobProvince'];
                $JobProgram = $fetch_row['jobProgram'];
                $MinimumYear = $fetch_row['minimumYear'];
                $Verified = $fetch_row['verified'];

                echo '<tr>';
                echo   '<td>' . $JobType . '</td>';
                echo   '<td>' . $JobProvince . '</td>';
                echo   '<td>' . $JobProgram . '</td>';
                echo   '<td>' . $MinimumYear . '</td>';
                if($Verified == "YES")
                    echo "<td> <p style=\"color:green;\"> YES </p> </td>";
                else
                    echo "<td> <p style=\"color:red;\"> NO </p> </td>";
                echo "<td> <p style=\"color:blue;\"> Applied </p> </td>";
                // each job's overview in every row
                echo   '</tr>';

                echo "</table>";
            }
        } 
        else{
            echo "$stud_name".", you have not applied for any job yet!";
        }
        ?>

        </form>

</div>
<!--End of Body -->
 
 <!--Footer -->
 <div class="footer">
  <p>@CollegeHire2021</p>
</div>
  <!-- End of Footer -->
</body>
</html>