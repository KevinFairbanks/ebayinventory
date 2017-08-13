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

<section style='background-color:#ededed;padding:15px;'>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Categories</h1>
                <form method="post" action='/' class="" style='margin-bottom:15px;'>
                    <div class="input-group">
                        <input type="text" name="catname" value="" class='form-control'>
                        <span class="input-group-btn">
                            <button type="submit" name="addcat" value="Add Category" class="btn btn-primary">Add Category</button>
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
                            <th>Category Name</th>
                            <th width="100"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <form class="" method="post">

                        <?php while($row = mysqli_fetch_object($catr)): ?>
                            <tr>
                                <td class='align-middle'>
                                    <?php
                                        echo ucwords(strtolower($row->type));
                                    ?>
                                </td>
                                <td>
                                    <button type="submit" name="removecat" class='btn btn-danger' value='<?php echo $row->id?>'>Delete</button>
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
