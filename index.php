<?php
    include('includes/config.php');
    session_start();

    if (!isset($_SESSION['auth']) || $_SESSION['auth'] != 1) {
        header('Location: login.php');
        exit();
    }

    include('includes/functions.php');
    include('includes/header.php');
    include('includes/nav.php');
?>
<section style='margin-top:45px;'>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="ui-container dash">
                    <h3>Items</h3>
                    <h1><a href="items.php"><?php echo getNumberCount('item'); ?></a></h1>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ui-container dash">
                    <h3>Bins</h3>
                    <h1><a href="bins.php"><?php echo getNumberCount('bin'); ?></a></h1>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ui-container dash">
                    <h3>Categories</h3>
                    <h1><a href="categories.php"><?php echo getNumberCount('category'); ?></a></h1>
                </div>
            </div>

        </div>
    </div>

</section>
<?php include('includes/footer.php'); ?>
