<?php
session_start();
// Redirect to login page if user is not logged in 
if (!isset($_SESSION['loggedin']) || ($_SESSION['usertype']!=='employer')) {
	header('Location: index.php');
	exit;
}
require_once 'connection.php';

//note that this ID is the employer ID
if(isset($_GET['id'])){
    //get user id 
    $Employer_userID = $_SESSION['userID'];
    $EmployerID =$GET['id'];
    $qry = mysqli_query($con,"SELECT * from employer WHERE userID='$Employer_userID'"); // select query

    $data = mysqli_fetch_array($qry); // fetch data
    
    if (isset($_POST['update'])) // when click on Update button
    {
        $EmployerDescription = $_POST['EmployerDescription'];
        $EmployerName = $_POST['EmployerName'];


        $edit = mysqli_query($con, "UPDATE employer set "
                . "employerDescription='$EmployerDescription' , "
                . "employerName='$EmployerName' "
                . "where userID='$Employer_userID'");

        if ($edit) {
            mysqli_close($con); // Close connection
            header("location:employerPage.php"); // redirects to all records page
            exit;
        }
    }

}
?>

<html>
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
    <h4>Update Data</h4>

    <form action = "" method="POST">
        
        <p>Employer Name</p>
        <input type="text" size="50" name="EmployerName" value="<?php echo $data['employerName'] ?>" placeholder="Enter your Name" Required>
        <br>
        <p>Employer Description:</p>
        <textarea name="EmployerDescription" rows="15" cols="43" Required>
        <?php echo $data['employerDescription'] ?>
        </textarea>
        <br>
        <br>
        <input type="submit" name="update" value="Update">
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