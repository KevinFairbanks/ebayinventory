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

<?php  // LIST OF BINS ?>
<section style='background-color:#FFF;padding:15px;'>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Bins</h1>
                <form method="post" action='/' class="" style='margin-bottom:15px;'>
                    <div class="input-group">
                        <input type="text" name="binnumber" value="" class='form-control'>
                        <span class="input-group-btn">
                            <button type="submit" name="addbin" value="Add Bin" class="btn btn-primary ">Add Bin</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class='table table-bordered table-striped'>
                    <thead class='thead-inverse'>
                        <tr>
                            <th>Bin Label / Bin Color</th>
                            <th width="100"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <form class="" method="post">

                        <?php while($row = mysqli_fetch_object($binr)): ?>
                            <tr>
                                <td class='align-middle'>
                                    Bin
                                    <span style='padding:5px;border-radius:4px;color:white;background-color:<?php echo $row->color; ?>'>
                                        <?php echo $row->bid; ?>
                                    </span>
                                </td>
                                <td>
                                    <button type="submit" name="removebin" class='btn btn-danger' value='<?php echo $row->id?>'>Delete</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>

                        </form>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>
<?php include('includes/footer.php'); ?>
