<?php
    session_start();
    include('includes/config.php');
    include('includes/header.php');
    include('includes/functions.php');

    if (!isset($_SESSION['auth']) || $_SESSION['auth'] != 1) {
        header('Location: login.php');
        exit();
    }

    if(isset($_GET['bin'])){
        $searchBin = $_GET['bin'];

        $chkbinq = "SELECT * from bin WHERE bid='$searchBin'";
        $chkbinr = mysqli_query($conn, $chkbinq);
        $row = mysqli_fetch_object($chkbinr);

        $itemq = "SELECT * from item WHERE binID='$row->id' ORDER BY id ASC";
        $itemr = mysqli_query($conn,$itemq);

    }


?>

<section style='padding:15px;'>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Item Search</h1>
                <form method="post" action='/' style='margin-bottom:15px;'></form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php
                    $num_rows = mysqli_num_rows($itemr);
                    if($num_rows <= 0){
                        echo "Nothing in that Bin.";
                    }
                ?>
                <?php while($row = mysqli_fetch_object($itemr)): ?>
                <?php
                    if($row->isListed == "1"){
                        $listLabel = "listed";
                    }else{
                        $listLabel = "";
                    }
                ?>
                <div class="ui-container item">
                    <?php
                        $q1 = "SELECT * FROM bin where id='$row->binID'";
                        $r1 = mysqli_query($conn, $q1);
                        $row1 = mysqli_fetch_object($r1);

                        echo "<div class='info-bar'><span class='$listLabel'>$listLabel</span> <span class='bin' style='background-color:$row1->color;'>Bin $row1->bid</span></div>";
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php echo "<div class='title'>$row->title</div>"; ?>
                            <b>Brand: </b><?php echo $row->brand ?> | <b>Color</b>: <?php echo $row->color ?> | <b>Size</b>: <?php echo $row->size ?> |
                            <?php
                                $q4 = "SELECT * FROM category where id='$row->categoryID'";
                                $r4 = mysqli_query($conn,$q4);
                                $row4 = mysqli_fetch_object($r4);
                                echo "<b>Category</b>: ".$row4->type." | ";
                            ?>
                            <b>Item</b>: <?php echo $row->serialnum; ?>
                        </div>
                    </div>

                </div>

                <?php endwhile; ?>

            </div>
        </div>

    </div>
</section>

<?php include('includes/footer.php'); ?>
