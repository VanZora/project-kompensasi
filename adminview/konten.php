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
    else if(@$_GET['page']=='set_kegiatan'){
        include "set_kegiatan.php";
    }
    else if(@$_GET['page']=='tambah_kegiatan'){
        include "tambah_kegiatan.php";
    }
    else if(@$_GET['page']=='progress'){
        include "progress.php";
    }

    else {
        include "dashboard.php";
        //header("location:dashboard.php");
    }
    

    
?>