<?php

    function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    function random_color() {
        return random_color_part() . random_color_part() . random_color_part();
    }

    $binq = "SELECT * from bin ORDER BY bid ASC";
    $binr = mysql_query($binq);

    $catq = "SELECT * from category ORDER BY type ASC";
    $catr = mysql_query($catq);

    $itemq = "SELECT * from item ORDER BY id ASC";
    $itemr = mysql_query($itemq);

    if($_POST["addbin"]) {
        $bin = strtoupper($_POST['binnumber']);
        $color = random_color();

        //check current bins
        $cbin = "SELECT * FROM bin WHERE bid='$bin'";
        $rbin = mysql_query($cbin);
        $numrows = mysql_num_rows($rbin);

        if($numrows == 0){
            $q = "INSERT into bin (bid, color) VALUES ('$bin', '#$color')";
            $r = mysql_query($q);
            header("location: bins.php");
        }else{
            echo "that bin exists";
        }
    }

    if($_POST["additem"]) {

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
        for($i=0;$i<6;$i++){
            $sn .= (!($i % 5) && $i ? '' : '').$chars[rand(0, $max)];
        }


        $q = "INSERT into item (brand, title, description, photo, color, size, serialnum, binID, categoryID, isSold,isListed) VALUES ('$brand','$title','$desc','$file','$color','$size', '$sn','$binnumber','$catID','$sold','$listed')";
        $r = mysql_query($q);

        header("location: items.php");
        // if($r){
        //     header("location: items.php");
        // }else{
        //
        // }



    }

    if($_POST["addcat"]) {
        $cat = str_replace("'","&rsquo;",$_POST['catname']);

        //check current bins
        $ccat = "SELECT * FROM category WHERE type='$cat'";
        $rcat = mysql_query($ccat);
        $numrows = mysql_num_rows($rcat);

        if($numrows == 0){
            $q = "INSERT into category (type) VALUES ('$cat')";
            $r = mysql_query($q);
            header("location: categories.php");
        }else{
            echo "that category exists";
        }
    }

    if($_POST["removebin"]){
        $rbin = $_POST["removebin"];
        $q = "DELETE FROM bin WHERE id='$rbin'";
        $r = mysql_query($q);
        header("location: bins.php");
    }
    if($_POST["removecat"]){
        $rcat = $_POST["removecat"];
        $q = "DELETE FROM category WHERE id='$rcat'";
        $r = mysql_query($q);
        header("location: categories.php");
    }

    function getNumberCount($type){

        switch($type){
            case "item":
                $q = "SELECT COUNT(id) from item";
                $r = mysql_query($q);
                $count = mysql_fetch_array($r);
                if($num_rows < 0){
                    return "0";
                }else{
                    return $count[0];
                }
            break;
            case "bin":
                $q = "SELECT COUNT(id) from bin";
                $r = mysql_query($q);
                $count = mysql_fetch_array($r);
                return $count[0];
            break;
            case "category":
                $q = "SELECT COUNT(id) from category";
                $r = mysql_query($q);
                $count = mysql_fetch_array($r);
                return $count[0];
            break;
        }

    }
?>
