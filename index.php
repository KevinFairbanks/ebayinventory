<?php
    include('includes/config.php');
    session_start();

    if (!isset($_SESSION['auth']) || $_SESSION['auth'] != 1) {
        header('Location: login.php');
        exit();
    }

    include('includes/functions.php');
    include('includes/header.php');
?>
<section style='margin-top:45px;'>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="" style='padding:15px;border:1px solid #CCC;color:#666; text-shadow:0px 2px 1px #FFF; border-radius:4px;text-align:center;background-color:#ededed'>
                    <h3>Current Items</h3>
                    <h1><a href="items.php"><?php echo getNumberCount('item'); ?></a></h1>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="" style='padding:15px;border:1px solid #CCC;color:#666; text-shadow:0px 2px 1px #FFF; border-radius:4px;text-align:center;background-color:#ededed'>
                    <h3>Current # of Bins</h3>
                    <h1><a href="bins.php"><?php echo getNumberCount('bin'); ?></a></h1>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="" style='padding:15px;border:1px solid #CCC;color:#666; text-shadow:0px 2px 1px #FFF; border-radius:4px;text-align:center;background-color:#ededed'>
                    <h3>Current # of Categories</h3>
                    <h1><a href="categories.php"><?php echo getNumberCount('category'); ?></a></h1>
                </div>
            </div>

        </div>
    </div>

</section>
<?php include('includes/footer.php'); ?>
