<?php
    session_start();
    include('includes/config.php');
    include('includes/header.php');
    include('includes/functions.php');

    if (!isset($_SESSION['auth']) || $_SESSION['auth'] != 1) {
        header('Location: login.php');
        exit();
    }

    $itemq = "SELECT * from item ORDER BY id ASC";
    $itemr = mysqli_query($conn,$itemq);
?>

<section style='padding:15px;'>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Items</h1>
                <form method="post" action='/' style='margin-bottom:15px;' class='ui-container'>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" name="brand" value="" class='form-control' placeholder="Brand">
                            </div>
                            <div class="form-group">
                                <input type="text" name="title" value="" class='form-control' placeholder="Title">
                            </div>
                            <div class="form-group">
                                <input type="text" name="color" value="" class='form-control' placeholder="Color">
                            </div>
                            <div class="form-group">

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select class="form-control" name="binum">
                                    <option value="">Select Bin</option>
                                    <?php
                                        $q = "SELECT * FROM bin";
                                        $r = mysqli_query($conn,$q);
                                        while($row = mysqli_fetch_object($r)){
                                            echo "<option value='$row->id'>$row->bid</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="catid">
                                    <option value="">Select Category</option>
                                    <?php
                                        $q3 = "SELECT * FROM category";
                                        $r3 = mysqli_query($conn,$q3);
                                        while($row3 = mysqli_fetch_object($r3)){
                                            echo "<option value='$row3->id'>$row3->type</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="size" value="" class='form-control' placeholder="Size">
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <button type="submit" name="additem" value="Add Item" class="btn btn-primary">Add Item</button>
                        <label class="form-check-label">
                          <input type="checkbox" name="listed" value="1">
                          is listed
                        </label>
                    </div>

                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
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
                <div id="accordion" role="tablist">
                  <div class="card">
                    <div class="card-header" role="tab" id="headingOne">
                      <h5 class="mb-0">
                        <div data-toggle="collapse" href="#collapse<?php echo $row->id; ?>" aria-expanded="true" aria-controls="collapseOne">
                          <?php echo $row->brand; ?> - <?php echo $row->title; ?>

                          <div class="float-right">
                              <div class='info-bar'><span class='<?php echo $listLabel; ?>'><?php echo $listLabel ?></span> <span class='bin' style='background-color:<?php echo $row1->color; ?>;'>Bin <?php echo $row1->bid ?></span></div>
                          </div>
                      </div>
                      </h5>
                    </div>

                    <div id="collapse<?php echo $row->id; ?>" class="collapse hide" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body">
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
                </div>

                <?php endwhile; ?>

            </div>
        </div>

    </div>
</section>

<?php include('includes/footer.php'); ?>
