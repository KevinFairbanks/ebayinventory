<?php
    session_start();

    if (!isset($_SESSION['auth']) || $_SESSION['auth'] != 1) {
        header('Location: login.php');
        exit();
    }

    include('includes/config.php');

    if(isset($_GET['bin'])){
        $searchBin = $_GET['bin'];

        $chkbinq = "SELECT * from bin WHERE bid='$searchBin'";
        $chkbinr = mysqli_query($conn, $chkbinq);
        $row = mysqli_fetch_object($chkbinr);

        $itemq = "SELECT * from item WHERE binID='$row->id' ORDER BY id ASC";
        $itemr = mysqli_query($conn,$itemq);

    }else{
        $itemq = "SELECT * from item ORDER BY id ASC";
        $itemr = mysqli_query($conn,$itemq);
    }
    include('includes/header.php');
    include('includes/functions.php');
    include('includes/nav.php');
?>

<section style='padding:15px;'>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>
                    Item Search
                    <?php
                        if(isset($_GET['bin'])){
                            echo " in bin " . $_GET['bin'];
                        }
                    ?>
                </h1>
                <form method="post" action='/' style='margin-bottom:15px;'></form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="accordion" role="tablist">
                <?php
                    $num_rows = $itemr->num_rows;
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
                <?php
                    $q1 = "SELECT * FROM bin where id='$row->binID'";
                    $r1 = mysqli_query($conn, $q1);
                    $row1 = mysqli_fetch_object($r1);
                ?>

                <div class="card">
                  <div class="card-header" role="tab" id="heading<?php echo $row->id; ?>" data-toggle="collapse" href="#collapse<?php echo $row->id; ?>" aria-expanded="true" aria-controls="collapse<?php echo $row->id; ?>">
                      <div class="row">
                          <div class="col-lg-8 col-xl-8 title">
                              <?php
                                  if($row->isNWT=='1'){
                                      echo "<span class=nwt>NWT</span>";
                                  }
                              ?>
                              <?php echo $row->brand; ?> - <?php echo $row->title; ?>
                          </div>

                          <div class="col-lg-4 col-xl-4 serial">
                              <b>Weight</b>: <?php echo $row->weight ?> |
                              <b>Item</b>: <?php echo $row->serialnum; ?>
                          </div>
                      </div>
                  </div>
                  <div id="collapse<?php echo $row->id; ?>" class="collapse" role="tabpanel" aria-labelledby="heading<?php echo $row->id; ?>" data-parent="accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 item-info">
                                <b>Brand</b>: </b><?php echo $row->brand ?><br>
                                <b>Color</b>: <?php echo $row->color; ?><br>
                                <b>Size</b>: <?php echo $row->size ?><br>
                                <b>Weight</b>: <?php echo $row->weight ?><br>
                                <?php
                                    $q4 = "SELECT * FROM category where id='$row->categoryID'";
                                    $r4 = mysqli_query($conn,$q4);
                                    $row4 = mysqli_fetch_object($r4);
                                    echo "<b>Category</b>: ".$row4->type." | ";
                                ?>
                                <span class='bin' style='background-color:<?php echo $row1->color; ?>;'>Bin <?php echo $row1->bid ?></span>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>

                <?php endwhile; ?>
                </div>
            </div>
        </div>

    </div>
</section>

<?php include('includes/footer.php'); ?>
