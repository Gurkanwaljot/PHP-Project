 <?php
    session_start();
  
    require_once "connection.php";
    
    $id = $_GET['id'];
    $sql_JobTable = "SELECT * FROM job WHERE EmployerID='$id'";
    $result = $con->query($sql_JobTable);
    $r = $result->num_rows;
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
        <?php
        
        if ($result->num_rows > 0) {
                            
                echo '<table border="1px">';
                    echo  '<thead>';
                        echo '<tr>';
                            echo '<th>Job ID</th>';
                            echo '<th>Job Title</th>';
                            echo '<th>Job Description</th>';
                            echo '<th>JOb Province</th>';
                            echo '<th>Job Location </th>';
                            echo '<th>Job Program</th>';
                            echo '<th>MinimumYear</th>';
                            echo '<th>Verified</th>';
                            echo '<th> Delete Job </th>';
                        echo'</tr>';
                    echo  '</thead>';
                    echo  '<tbody>';
                    while($row = $result->fetch_assoc()){
                            $verifiedbool = ($row["verified"]==0)? 'Unverified' :'Verified by Admin';
                            echo '<tr>';
                                echo   '<td>' . $row['jobID'] . '</td>';
                                echo   '<td>' .$row['jobType'] . '</td>';
                                echo    '<td>' .$row['jobDescription'] . '</td>';
                                echo   '<td>' . $row['jobProvince']. '</td>';
                                echo   '<td>' . $row['jobLocation'] . '</td>';
                                echo   '<td>' . $row['jobProgram']. '</td>';
                                echo   '<td>' . $row['minimumYear']. '</td>';
                                echo   '<td>'.$verifiedbool.'</td>';
                                echo   '<td><button><a href ="deleteEmpJob.php?id='.$row['jobID'].'">Delete</a></button></td>';
                            echo  '</tr>';

                    }
                    echo  '</tbody>';
                echo '</table>';
            
        } else {
            echo "No Job Added Yet! <br>";
            
        }
        echo '<br>';
        echo '<button><a href="JobForm.php">Add Job</a></button>';
        $con->close();
        ?>

 </div>
<!--End of Body -->
 
 <!--Footer -->
 <div class="footer">
  <p>@CollegeHire2021</p>
</div>
  <!-- End of Footer -->
</body>
</html>