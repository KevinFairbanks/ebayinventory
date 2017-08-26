
<?php include('includes/header.php'); ?>

<div class="container">
    <div class="row justify-content-center">
    <div class="col-lg-4">
        <div class="login">
            <img src="img/ebay-logo.png" alt="">
            <form method="post" action="auth.php">
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
