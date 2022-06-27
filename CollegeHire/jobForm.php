<?php
    session_start();
    require_once 'connection.php';
    // Redirect to login page if user is not logged in 
    if (!isset($_SESSION['loggedin']) || ($_SESSION['usertype']!=='employer')) {
            header('Location: index.php');
            exit;
    }
    
    //get user id 
    $Employer_userID = $_SESSION['userID'];
    
    //get employer id
    $query = "SELECT employerID from employer WHERE userID = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $Employer_userID);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    $Employer_ID = $row["employerID"];
    
    
    if (isset($_POST['JobType']) && isset($_POST['JobDescription']) && 
        isset($_POST['JobProvince']) && isset($_POST['JobLocation']) && 
        isset($_POST['JobProgram']) && isset($_POST['MinimumYear'])) 
    {
        $JobType = $_POST['JobType'];
        $JobDescription = $_POST['JobDescription'];
        $JobProvince = $_POST['JobProvince'];
        $JobLocation = $_POST['JobLocation'];
        $JobProgram = $_POST['JobProgram'];
        $MinimumYear = $_POST['MinimumYear'];
        
    
        $sql_add_query_Job ="INSERT INTO job VALUES "
                . "( null, '$JobType', '$JobDescription','$JobProvince', "
                . "'$JobLocation', '$JobProgram', '$MinimumYear', default,'$Employer_ID')";
    
        //error_log("Records here: " . $sql_add_query_Job);
    
        if ($con-> query($sql_add_query_Job)  === FALSE) {
            die("Could not add Job");
        }
    }
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
        <a href="displayemployerjobs.php?id=<?php echo $Employer_ID ?>">DISPLAY COMPANY JOBS</a> 


</div>
<!--End of Header -->

<!--Body -->
 <div class="body">
       <form action = " " method="POST">
       <br><br>
           <table>

           <tr>
               <th>Job Title </th>
                <td><input type="text" size="60" name="JobType"></td>
               </td>
           </tr>
           <tr>
               <th>Job Description </th>
               <td><textarea  rows="20" cols="50" name="JobDescription"></textarea></td>
           </tr>
           <tr>
               <th>Job Province </th>
               <td>
               <label for="JobProvince"></label>
                <select name="JobProvince" id="JobProvince">
                    <option value="none"> choose your province </option>
                    <option value="BC"> BC</option>
                    <option value="AB"> AB </option>
                    <option value="NB"> NB </option>
                </select>
               </td>
           </tr>
           <tr>
               <th>Job Location</th>
               <td><input type="text" size="60" name="JobLocation"></td>
           </tr>
           <tr>
               <th>Job Program </th>
               <td>
               <label for="JobProgram"></label>
                <select name="JobProgram" id="JobProgram">
                    <option value="none"> choose a job program </option>
                    <option value="General"> General</option>
                    <option value="Science"> Science </option>
                    <option value="Applied Science"> Applied Science </option>
                    <option value="Law"> Law </option>
                    <option value="Psychology"> Psychology </option>
                    <option value="HR"> HR </option>
                </select>
               </td>
           </tr>
           <tr>
               <th>Minimum Year </th>
               <td>
               <label for="MinimumYear"></label>
                <select name="MinimumYear" id="MinimumYear">
                    <option value="none"> choose a minimum study year </option>
                    <option value="1st"> 1st</option>
                    <option value="2nd"> 2nd </option>
                    <option value="3rd"> 3rd </option>
                    <option value="4th/LastYear"> 4th/LastYear </option>
                </select>
               </td>
           </tr>
           <tr>
               <th>Verified </th>
               <td><input type="checkbox" disabled ></td>
           </tr>
           </table>
           <br>
           <input type='submit' name='submit' value='Add Job Form'>
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