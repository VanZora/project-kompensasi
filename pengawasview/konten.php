<?php

    if(@$_GET['page']=='dashboard'){
        include "dashboard.php";
    }
    else if(@$_GET['page']=='list'){
        include "list.php";
    }

    else {
        include "dashboard.php";
        //header("location:dashboard.php");
    }
    

    
?>