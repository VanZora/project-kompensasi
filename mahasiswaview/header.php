<header class="header body-pd" id="header">
        <div class="header_toggle"> <i class='bx bx-menu bx' id="header-toggle"></i> </div>
        <img src="image/Logo2-E2.png" width="10%">
        <div class="header_img"> <img src="image/Logo-.jpeg" alt=""> </div>
    </header>
    <div class="l-navbar show" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Mahasiswa</span> </a>
                <div class="nav_list"> 
                    <a href="?page=dashboard" class="nav_link <?php if($page=='dashboard'){ echo "active"; }?>"> <i class='bx bx-train nav_icon'></i> 
                    <span class="nav_name">Dashboard</span> </a> 
                    <a href="?page=kompensasi" class="nav_link <?php if($page=='kompensasi'){ echo "active"; }?>"> <i class='bx bx-station nav_icon'></i> 
                    <span class="nav_name">Kompensasi</span> </a> 
                    <a href="?page=jadwalpage" class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i> 
                    <span class="nav_name">AD</span> </a> </div>
            </div> <a href="../logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="height-100 bg-white">
        <div class="container-fluid">