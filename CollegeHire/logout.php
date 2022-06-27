
 <?php 
 session_start();


	unset($_SESSION['name']);
	unset($_SESSION['id']);
        unset($_SESSION['usertype']);
        unset($_SESSION['userID']);
        $_SESSION['loggedin'] = FALSE;
	session_destroy();
        

	header('location:index.php');

?>

