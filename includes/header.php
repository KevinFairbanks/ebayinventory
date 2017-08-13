<?php
    $curdir = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/base.css">

  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">Inventory</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item <?php if($curdir == "index.php"){echo "active";} ?>">
                <a class="nav-link" href="index.php">Dashboard <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item <?php if($curdir == "items.php"){echo "active";} ?>">
                <a class="nav-link" href="items.php">Items</a>
              </li>
              <li class="nav-item <?php if($curdir == "bins.php"){echo "active";} ?>">
                <a class="nav-link" href="bins.php">Bins</a>
              </li>
              <li class="nav-item <?php if($curdir == "categories.php"){echo "active";} ?>">
                <a class="nav-link" href="categories.php">Categories</a>
              </li>
              <li class="nav-item <?php if($curdir == "search.php"){echo "active";} ?>">
                <a class="nav-link" href="categories.php">Quick Search</a>
              </li>
            </ul>
          </div>
        </nav>
