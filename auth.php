<?php
    // GET SOME VARIABLES
    $name = $_POST['name'];
    $pass = $_POST['pass'];

    if( isset($name) || isset($pass) ){
        if( empty($name) ) {
            header('Location: login.php');
        }
        if( empty($pass) ) {
            header('Location: login.php');
        }
        if( $name == "ebay" && $pass == "ebay" ){
            // Authentication successful - Set session

            $_SESSION['auth'] = 1;
            setcookie("username", $_POST['name'], time()+(84600*30));
            header('Location: index.php');
            // exit;

        }else {
            echo "ERROR: Incorrect username or password!";
        }
    } else {

    }

?>
