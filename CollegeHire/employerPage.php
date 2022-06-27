<?php
session_start();
// Redirect to login page if user is not logged in 
if (!isset($_SESSION['loggedin']) || ($_SESSION['usertype']!=='employer')) {
	header('Location: index.php');
	exit;
}
require_once 'connection.php';

$DATABASE_TABLE="employer";

$Employer_userID = 9;//$_SESSION['userID'];


//check if employer with user ID already has an existing profile
$query2 = "SELECT * from $DATABASE_TABLE WHERE userID = ?";
$stmt2 = $con->prepare($query2);
$stmt2->bind_param("i",$Employer_userID);
$stmt2->execute();
$result2 = $stmt2->get_result();



$employer = $result2->fetch_assoc();

$total_employer_profiles = $result2->num_rows;

echo $total_employer_profiles;



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

  	<a href="logout.php"><i></i>LOGOUT</a>
        <?php
            if($total_employer_profiles!=0){
             echo '<a href="deleteEmpProfile.php?id='.$employer['employerID'].'"><i></i>DELETE PROFILE</a>';
             echo '<a href ="updateemployerprofile.php?id='.$employer['employerID'].'">UPDATE PROFILE</a>';
            }
        ?>

</div>
<!--End of Header -->

<!--Body -->
 <div class="body">
      
    <?php
    
      if($total_employer_profiles<1){
        echo '<form action ="addemployerprofile.php" method="POST">';
            
           echo ' <table >';
                
                echo ' <tr>';
                    echo '<th>Employer Name</th>';
                    echo '<td><textarea name="EmployerName" rows="1" cols="50"  ></textarea></td>';
                echo '</tr>';
                echo ' <tr>';
                    echo '<th>Employer Description</th>';
                    echo '<td><textarea name="EmployerDescription" rows="15" cols="50" ></textarea></td>';
                echo '</tr>';
                
                
            echo '</table><br>';
            echo' <input type="submit" name="submit" value="ADD PROFILE">';
        echo'</form>';
      
      
        }else{
            
            echo '<table width="100%"  cellspacing ="1px" cellpadding ="1px" border="1px">  ';
                echo  '<thead>';
                    echo  '<tr>';
                        echo  '<th width:40%>Employer Name</th>';
                        echo  '<th>Employer Description </th>';
                    echo  '</tr>';
                echo  ' </thead>';


                echo '<tbody>';
                    
                        echo '<tr>';
                         echo '<td width:40%>'.$employer["employerName"].'</td>';
                         echo '<td>'.$employer["employerDescription"].'</td>';
                        echo '</tr>';
                  
                echo '</tbody>';
            echo '</table>';

        }
        
    ?>
    <br>
    <br>
    <p><button><a href="JobForm.php"> CLICK HERE</a></button>   To Fill The Job Form and Add a Job</p>
    <br><br>
    
 </div>
<!--End of Body -->
 
 <!--Footer -->
 <div class="footer">
  <p>@CollegeHire2021</p>
</div>
  <!-- End of Footer -->
</body>
</html>