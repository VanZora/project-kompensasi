<?php

    if(@$_GET['page']=='dashboard'){
        include "dashboard.php";
    }
    else if(@$_GET['page']=='list'){
        include "list.php";
    }
    else if(@$_GET['page']=='kegiatan'){
        include "kegiatan.php";
    }

    else {
        include "dashboard.php";
        //header("location:dashboard.php");
    }
    

    
?>