<?php

    if(@$_GET['page']=='dashboard'){
        include "dashboard.php";
    }
    else if(@$_GET['page']=='detail'){
        include "detail.php";
    }
    else if(@$_GET['page']=='kompensasi'){
        include "kompensasi.php";
    }
    else if(@$_GET['page']=='kegiatan'){
        include "kegiatan.php";
    }

    else {
        include "dashboard.php";
        //header("location:dashboard.php");
    }
    

    
?>