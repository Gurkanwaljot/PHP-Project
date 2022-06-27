<?php


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

        if ($stmt = $con->prepare("SELECT username, password ,userID,userType FROM $DATABASE_TABLE WHERE username = ?")) {

            $stmt->bind_param("s", $username);
                $stmt->execute();
                $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($username, $password,$userid,$usertype);
                $stmt->fetch();
                // verify the password.
                if ($_POST['password'] == $password) {
                    // User has logged-in!
                    // Create sessions
                    
                    session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['name'] = $username;
                    $_SESSION['id'] = rand();//random number generated
                    $_SESSION['usertype'] = $usertype;//user type
                    $_SESSION['userID'] = $userid;

                     
                    if($usertype=="employer"){
                         header('Location:employerPage.php');
                    }
                    else{
                        
                        if($usertype=="student"){
                         header('Location:studentPage.php');
                        }
                        else{
                           header('Location:adminPage.php');
                        }
                    }
                   

                } else {
                    // Incorrect password
                    echo 'Incorrect account and/or password! case 1';
                    header('Location: index.php');
                }
            } else {
                // Incorrect account
                echo 'Incorrect account and/or password case 2!';
                header('Location: index.php');
            }

                $stmt->close();
        }

?>
