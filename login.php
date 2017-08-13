<?php

    $name = $_POST['name'];
    $pass = $_POST['pass'];

    if( isset($name) || isset($pass) ){
        if( empty($name) ) {
            die ("ERROR: Please enter username!");
        }
        if( empty($pass) ) {
            die ("ERROR: Please enter password!");
        }

        if( $name == "listing" && $pass == "items_x!" ){

            // Authentication successful - Set session
            session_start();
            $_SESSION['auth'] = 1;
            setcookie("username", $_POST['name'], time()+(84600*30));
            header('Location: index.php');
            exit;
        }else {
            echo "ERROR: Incorrect username or password!";
        }
    } else {

    include('includes/header.php');
    // If no submission, display login form
?>
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-lg-4">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="">Username:</label>
                    <input type="text" name="name" value="<?php echo $_COOKIE['username']; ?>" class='form-control'>
                </div>
                <div class="form-group">
                    <label for="">Password: </label>
                    <input type="password" name="pass" class='form-control'>
                </div>
                <input type="submit" name="submit" value="Log In" class='btn btn-success'>
            </div>
        </div>
    </div>

<?php
}
    include('includes/footer.php');
?>
