<?php
    session_start();
    if (!isset($_SESSION['auth']) || $_SESSION['auth'] != 1) {
        header('Location: login.php');
        exit();
    }

    include('includes/config.php');
    include('includes/header.php');
    include('includes/functions.php');
    include('includes/nav.php');

    $itemq = "SELECT * from item WHERE isSold!='1' AND isListed='1' ORDER BY id ASC";
    $itemr = mysqli_query($conn,$itemq);

    $itemlistedq = "SELECT * from item WHERE isSold!='1' AND isListed='0' ORDER BY id ASC";
    $itemlistedr = mysqli_query($conn,$itemlistedq);

    if( isset($_POST['submit']) ){
        if( $_POST['submit'] == 'isSold' ){
            $updateItem = $_POST['itemID'];
            $q = "UPDATE item SET isSold ='1' WHERE id=$updateItem";
            $r = mysqli_query($conn, $q);
            header("Location: /items.php");
        }
        if( $_POST['submit'] == 'isListed' ){
            $updateItem = $_POST['setListed'];
            $q = "UPDATE item SET isListed ='1' WHERE id=$updateItem";
            $r = mysqli_query($conn, $q);
            header("Location: /items.php");
        }
    }
?>

<section style='padding:15px;'>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Items</h1>
                <form method="post" action='/' class='ui-container'>
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
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <input type="text" name="lb" value="" class='form-control' placeholder="lb">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="oz" value="" class='form-control' placeholder="oz">
                                </div>
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
                        <label class="form-check-label">
                          <input type="checkbox" name="nwt" value="1">
                          is NTW
                        </label>
                    </div>

                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="listed-items">
                    <h4>Listed Items (<?php echo mysqli_num_rows($itemr); ?>)</h4>
                    <div id="accordion" role="tablist">
                    <?php
                        if($row = mysqli_num_rows($itemr) == 0){
                            echo "<div class='no-items'><i>No Listed Items</i></div>";
                        }
                    ?>
                    <?php while($row = mysqli_fetch_object($itemr)): ?>

                        <form action="" method="post">
                            <input type="hidden" name="itemID" value="<?php echo $row->id; ?>">
                    <?php
                        if($row->isListed == "1"){
                            $listLabel = "Listed";
                        }else{
                            $listLabel = "Not listed";
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
                                  <div class="col-lg-9 item-info">
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
                                  <div class="col-lg-3 item-info-action">
                                      <div class="action-container">
                                          <button type="submit" name="submit" value="isSold" class='btn btn-danger issold' onClick="javascript: return confirm('Remove From List?');">Set as Sold</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                      </form>

                    <?php endwhile; ?>

                    </div>
                </div>

                <div class="unlisted-items">

                    <h4>Unlisted Items(<?php echo mysqli_num_rows($itemlistedr); ?>)</h4>

                    <?php
                        if($row = mysqli_num_rows($itemlistedr) == 0){
                            echo "<div class='no-items'><i>No Listed Items</i></div>";
                        }
                    ?>

                    <div id="accordion" role="tablist">

                    <?php while($row = mysqli_fetch_object($itemlistedr)): ?>
                        <form action="" method="post">
                            <input type="hidden" name="itemID" value="<?php echo $row->id; ?>">
                            <input type="hidden" name="setListed" value="<?php echo $row->id; ?>">
                    <?php
                        if($row->isListed == "1"){
                            $listLabel = "Listed";
                        }else{
                            $listLabel = "Not listed";
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
                                <div class="col-lg-8 title">
                                    <?php
                                        if($row->isNWT=='1'){
                                            echo "<span class=nwt>NWT</span>";
                                        }
                                    ?>
                                    <?php echo $row->brand; ?> - <?php echo $row->title; ?>
                                </div>
                                <div class="col-lg-4 serial">
                                    <b>Weight</b>: <?php echo $row->weight ?> |
                                    <b>Item</b>: <?php echo $row->serialnum; ?>
                                </div>
                            </div>
                        </div>
                        <div id="collapse<?php echo $row->id; ?>" class="collapse" role="tabpanel" aria-labelledby="heading<?php echo $row->id; ?>" data-parent="accordion">
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-lg-9 item-info">
                                      <b>Brand</b>: </b><?php echo $row->brand ?><br>
                                      <b>Color</b>: <?php echo $row->color; ?><br>
                                      <b>Size</b>: <?php echo $row->size ?><br>

                                      <?php
                                          $q4 = "SELECT * FROM category where id='$row->categoryID'";
                                          $r4 = mysqli_query($conn,$q4);
                                          $row4 = mysqli_fetch_object($r4);
                                          echo "<b>Category</b>: ".$row4->type." | ";
                                      ?>
                                      <span class='bin' style='background-color:<?php echo $row1->color; ?>;'>Bin <?php echo $row1->bid ?></span>
                                  </div>
                                  <div class="col-lg-3 item-info-action">
                                      <div class="action-container">
                                          <button type="submit" name="submit" value="isSold" class='btn btn-danger issold' onClick="javascript: return confirm('Remove From List?');">Set as Sold</button>
                                          <button type="submit" name="submit" value="isListed" class='btn btn-warning islisted' onClick="javascript: return confirm('Set as listed?');">Set as Listed</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                      </form>

                    <?php endwhile; ?>

                    </div>

                </div>



            </div>
        </div>

    </div>
</section>

<?php include('includes/footer.php'); ?>
