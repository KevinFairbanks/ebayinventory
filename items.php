<?php
    session_start();
    include('includes/config.php');
    include('includes/header.php');
    include('includes/functions.php');

    if (!isset($_SESSION['auth']) || $_SESSION['auth'] != 1) {
        header('Location: login.php');
        exit();
    }
?>

<section style='background-color:#ededed;padding:15px;'>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Items</h1>
                <form method="post" action='/' style='margin-bottom:15px;' class='new-item'>
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
                                <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="checkbox" name="listed" value="1">
                                      is listed
                                    </label>
                                    <label class="form-check-label">
                                      <input type="checkbox" name="sold" value="1">
                                      is sold
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <select class="form-control" name="binum">
                                    <option value="">Select Bin</option>
                                    <?php
                                        $q = "SELECT * FROM bin";
                                        $r = mysql_query($q);
                                        while($row = mysql_fetch_object($r)){
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
                                        $r3 = mysql_query($q3);
                                        while($row3 = mysql_fetch_object($r3)){
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
                    <button type="submit" name="additem" value="Add Item" class="btn btn-primary">Add Item</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php while($row = mysql_fetch_object($itemr)): ?>
                <div class="item">

                    <div class="row">
                        <div class="col-lg-6">
                            <b><?php echo $row->brand ?></b><br>
                            <?php echo $row->title ?>
                            <div class="">Color: <?php echo $row->color ?></div>
                            <div class="">Size: <?php echo $row->size ?></div>
                        </div>
                        <div class="col-lg-3">
                            <div class="">
                                Item#: <?php echo $row->serialnum; ?>
                                <?php
                                    $q1 = "SELECT * FROM bin where id='$row->binID'";
                                    $r1 = mysql_query($q1);
                                    $row1 = mysql_fetch_object($r1);
                                    echo "Bin#: <span style='padding:3px;border-radius:4px;background-color:$row1->color;color:white'>$row1->bid</span>";
                                ?>
                            </div>
                            <div class="">


                                <?php
                                    $q4 = "SELECT * FROM category where id='$row->categoryID'";
                                    $r4 = mysql_query($q4);
                                    $row4 = mysql_fetch_object($r4);
                                    echo "Category: ".$row4->type;
                                ?>
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
