<?php

    function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    function random_color() {
        return random_color_part() . random_color_part() . random_color_part();
    }

    if(isset($_POST['addbin'])) {
        $bin = strtoupper($_POST['binnumber']);
        $color = random_color();

        //check current bins
        $cbin = "SELECT * FROM bin WHERE bid='$bin'";
        $rbin = mysqli_query($conn,$cbin);
        $numrows = mysqli_num_rows($rbin);

        if($numrows == 0){
            $q = "INSERT into bin (bid, color) VALUES ('$bin', '#$color')";
            $r = mysqli_query($conn,$q);
            header("location: bins.php");
        }else{
            echo "that bin exists";
        }
    }

    if(isset($_POST["additem"])) {

        $file = $_POST['uploadedfile'];
        $brand = $_POST['brand'];
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $color = $_POST['color'];
        $size = $_POST['size'];
        $binnumber = $_POST['binum'];
        $catID = $_POST['catid'];
        $sold = $_POST['sold'];
        $listed = $_POST['listed'];

        if($sold == ""){
            $sold = '0';
        }
        if($listed == ""){
            $listed = '0';
        }

        $chars = array(0,1,2,3,4,5,6,7,8,9);
        $charsA = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $sn = 'SN';
        $max = count($chars)-1;
        for($i=0;$i<1;$i++){
            $sn .= (!($i % 5) && $i ? '' : '').$charsA[rand(0, $max)];
        }
        for($i=0;$i<4;$i++){
            $sn .= (!($i % 5) && $i ? '' : '').$chars[rand(0, $max)];
        }

        $q = "INSERT into item (brand, title, description, photo, color, size, serialnum, binID, categoryID, isSold,isListed) VALUES ('$brand','$title','$desc','$file','$color','$size', '$sn','$binnumber','$catID','$sold','$listed')";
        $r = mysqli_query($conn,$q);

        header("location: items.php");

    }
    // if(isset($_POST["searchitems"])) {
    //
    //     $filterKeyword = $_POST['filter'];
    //     $keyword = $_POST['sch'];
    //
    //     switch($filterKeyword){
    //         case "Brand":
    //         $customSearch = "brand LIKE '%$keyword%'";
    //         break;
    //         case "Bin":
    //         break;
    //         case "Category":
    //         break;
    //         case "Size":
    //         break;
    //     }
    //     $searchquery = "SELECT * FROM item WHERE $customSearch";
    //     exit();
    // }
    if(isset($_POST["addcat"])) {
        $cat = str_replace("'","&rsquo;",$_POST['catname']);

        //check current bins
        $ccat = "SELECT * FROM category WHERE type='$cat'";
        $rcat = mysqli_query($conn,$ccat);
        $numrows = mysqli_num_rows($rcat);

        if($numrows == 0){
            $q = "INSERT into category (type) VALUES ('$cat')";
            $r = mysqli_query($conn, $q);
            header("location: categories.php");
        }else{
            echo "that category exists";
        }
    }

    if(isset($_POST["removebin"])){
        $rbin = $_POST["removebin"];
        $q = "DELETE FROM bin WHERE id='$rbin'";
        $r = mysqli_query($conn, $q);
        header("location: bins.php");
    }
    if(isset($_POST["removecat"])){
        $rcat = $_POST["removecat"];
        $q = "DELETE FROM category WHERE id='$rcat'";
        $r = mysqli_query($conn, $q);
        header("location: categories.php");
    }

    function getNumberCount($type){
        global $conn;
        switch($type){
            case "item":
                $q = "SELECT COUNT(id) from item";
                $r = mysqli_query($conn, $q);
                $count = mysqli_fetch_array($r);
                if($count < 0){
                    return "0";
                }else{
                    return $count[0];
                }
            break;
            case "bin":
                $q = "SELECT COUNT(id) from bin";
                $r = mysqli_query($conn,$q);
                $count = mysqli_fetch_array($r);
                return $count[0];
            break;
            case "category":
                $q = "SELECT COUNT(id) from category";
                $r = mysqli_query($conn,$q);
                $count = mysqli_fetch_array($r);
                return $count[0];
            break;
        }

    }
?>
