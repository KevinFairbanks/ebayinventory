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

        $brand = isset($_POST['brand']) ? $_POST['brand'] : '';
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $color = isset($_POST['color']) ? $_POST['color'] : '';
        $size = isset($_POST['size']) ? $_POST['size'] : '';
        $binnumber = isset($_POST['binum']) ? $_POST['binum'] : '';
        $catID = isset($_POST['catid']) ? $_POST['catid'] : '';
        $nwt = isset($_POST['nwt']) ? $_POST['nwt'] : '0';
        $listed = isset($_POST['listed']) ? $_POST['listed'] : '0';
        $lb = isset($_POST['lb']) ? $_POST['lb'] : '0';
        $oz = isset($_POST['oz']) ? $_POST['oz'] : '0';

        $weight = $lb . "lb " . $oz . "oz";

        $brand = addslashes($brand);
        $title = addslashes($title);
        $color = addslashes($color);
        $binnumber = addslashes($binnumber);
        $size = addslashes($size);

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

        $q = "INSERT into item (brand,title,color,size,serialnum,binID,categoryID,isListed,weight,isNWT) VALUES ('$brand','$title','$color','$size', '$sn','$binnumber','$catID','$listed','$weight','$nwt')";
        $r = mysqli_query($conn,$q);

        header("location: items.php");

    }

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
    if(isset($_POST["fullbin"])){
        $rbin = $_POST["fullbin"];
        $q = "UPDATE bin SET full='1' WHERE id='$rbin'";
        $r = mysqli_query($conn, $q);
        header("location: bins.php");
    }
    if(isset($_POST["availbin"])){
        $rbin = $_POST["availbin"];
        $q = "UPDATE bin SET full='0' WHERE id='$rbin'";
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
            case "sold":
                $q = "SELECT COUNT(id) from item where isSold='1'";
                $r = mysqli_query($conn,$q);
                $count = mysqli_fetch_array($r);
                return $count[0];
            break;
        }

    }
?>
