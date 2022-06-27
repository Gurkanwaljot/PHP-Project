<?php 
   require_once 'connection.php';
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
</div>
<!--End of Header -->

<!--Body -->
 <div class="body">
    <div class="signin-form">

    <div class="container">

            <form action ="completeRegister.php"  method="post" class="form-signin" enctype="multipart/form-data">
                <h2>Welcome! </h2><hr />
                <h4> Enter the following details to sign up: </h4>
                <?php
                            if(isset($error))
                            {
                                    foreach($error as $error)
                                    {
                                             ?>
                         <div class="alert alert-<?php echo $class; ?>">
                            <i class="glyphicon glyphicon-<?php echo $icon; ?>-sign"></i> &nbsp; <?php echo $error; ?>
                         </div>
                         <?php
                                    }
                            }
                            else if(isset($_GET['joined']))
                            {
                                     ?>
                     <div class="alert alert-info">
                          <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='index.php'>Login here</a> 
                     </div>
                     <?php
                            }
                            ?>
                <div class="form-group">
                    <p>Username:
                        <input type="text" class="form-control" name="username" placeholder="Enter Username" value="<?php if(isset($error)){echo $username;}?>" />
                    </p>
                </div>

                <div class="form-group">
                    <p>Password:
                        <input type="password" class="form-control" name="password" placeholder="Enter Password" />
                    </p>
                </div>

                <div class="form-group">
                    <p>User Type:
                        <label for="usertype"></label>
                        <select name="usertype" id="usertype">
                            <option value="none"> choose a user type </option>
                            <option value="employer"> employer</option>
                            <option value="student"> student </option>
                        </select>
                    </p>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="btn-signup">
                            <i class="glyphicon glyphicon-open-file"></i>&nbsp;SIGN UP
                    </button>
                </div>
                <br>
                <label>Already have an account? <a href="index.php">Log In</a></label>
            </form>
           </div>
    </div>

    </div>
 </div>
<!--End of Body -->
 
 <!--Footer -->
 <div class="footer">
  <p>@CollegeHire2021</p>
</div>
  <!-- End of Footer -->
</body>
</html>
