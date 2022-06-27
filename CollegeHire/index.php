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
    <h2>Welcome! </h2>
    <h4>Fill in the following information to login into the portal: </h4>
    <div class="signin-form">

            <div class="container">


           <form action ="completeLogin.php" class="form-signin" method="post" id="login-form">

            <h2 class="form-signin-heading"></h2><hr />

            <div id="error">
            <?php
                            if(isset($error))
                            {
                                    ?>
                    <div class="alert alert-danger">
                       <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                    </div>
                    <?php
                            }
                    ?>
            </div>

            <div class="form-group">
                 <p>Username:
                    <input type="username" class="form-control" name="username" placeholder="Username" required />
                </p>
            <span id="check-e"></span>
            </div>
            <div class="form-group">
                <p>Password:
                    <input type="password" class="form-control" name="password" placeholder="Password" />
                </p>
            </div>



            <div class="form-group">
                <button type="submit" name="btn-login" class="btn btn-default">
                            <i></i> &nbsp; SIGN IN
                </button>
            </div>  
            <br />
                <label>Don't have account yet? <a href="register.php">Sign Up</a></label>
          </form>

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

