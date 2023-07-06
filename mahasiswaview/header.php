<header class="header bayangan body-pd" id="header">
        <div class="header_toggle"> <i class='bx bx-menu bx' id="header-toggle"></i> </div>

        <div class="header_img"> </div>
    </header>
    <div class="l-navbar show" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class='bx bxs-user-circle nav_logo-icon'></i> <span class="nav_logo-name">Mahasiswa</span> </a>
                <div class="nav_list"> 
                    <a href="?page=dashboard" class="nav_link <?php if($page=='dashboard'){ echo "active"; }?>"> <i class='bx bxs-dashboard nav_icon'></i> 
                    <span class="nav_name">Dashboard</span> </a> 
                    <a href="?page=kompensasi" class="nav_link <?php if($page=='kompensasi'){ echo "active"; }?>"> <i class='bx bx-notepad nav_icon'></i> 
                    <span class="nav_name">Kompensasi</span> </a> </div>
            </div> <a href="../logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="height-100 bg-whitec"><br>
        <div class="container-fluid">