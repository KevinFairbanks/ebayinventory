<?php session_start(); ?>
<?php
    if($_SESSION['auth'] == 1){
        setcookie("username", $_POST['name'], time()+(84600*30));
        header('Location: index.php');
    }
?>
<?php include('includes/header.php'); ?>
<?php if( isset( $_POST['submit'] ) ): ?>
    <?php
        // GET SOME VARIABLES
        $name = $_POST['name'];
        $pass = $_POST['pass'];

        if( isset($name) || isset($pass) ){
            if( empty($name) ) {
                // header('Location: login.php');
            }
            if( empty($pass) ) {
                // header('Location: login.php');
            }
            if( $name == "ebay" && $pass == "ebay!_x" ){
                // Authentication successful - Set session

                $_SESSION['auth'] = 1;
                // setcookie("username", $_POST['name'], time()+(84600*30));
                // header('Location: index.php');
                // exit;

            }else {
                echo "ERROR: Incorrect username or password!";
            }
        } else {

        }

    ?>

<?php else: ?>
    <!-- enter some shit in already -->
<?php endif; ?>

<div class="container">
    <div class="row justify-content-center">
    <div class="col-lg-4">
        <div class="login">
            <img src="img/ebay-logo.png" alt="">
            <form method="post" action="">
                <div class="form-group">
                    <label for="">Username:</label>
                    <input type="text" name="name" value="" class='form-control'>
                </div>
                <div class="form-group">
                    <label for="">Password: </label>
                    <input type="password" name="pass" class='form-control'>
                </div>
                <input type="submit" name="submit" value="Log In" class='btn btn-success'>

            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
