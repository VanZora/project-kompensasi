<?php $page = "dashboard";
include 'header.php';
include "../function.php";
// if(array_key_exists('cetak', $_POST)) {
//     cetak();
// } untuk memanggil fungsi lewat button
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style2.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <style>
        table td,
        table td * {
            vertical-align: top;
            padding-right: 40px;
        }
    </style>
</head>

<body>



    <?php
    $user = $_SESSION["user"];

    $tuntas = mysqli_query($conn, "select * from mhs_kompen where nim_mhs='$user' and v_pengawas='VALID' and v_aprodi='VALID'");
    $waktu = mysqli_query($conn, "select * from admin_kompen INNER JOIN mhs_kompen ON admin_kompen.kode_kompen = mhs_kompen.kode_kompen where mhs_kompen.nim_mhs='$user'");
    $tenggat = mysqli_fetch_assoc($waktu);

    if (mysqli_num_rows($tuntas) == 1) {
    } else {
        echo '<div class="alert alert-danger">
        <strong>Kompensasi belum tuntas !</strong> kamu harus menyelesaikan kompensasi sebelum tanggal ' . $tenggat['waktu'] . '  <a style="text-decoration:underline ;" href="?page=kompensasi" class="alert-link">Klik disini !</a>.
        </div>';
    }
    ?>
    
   



    <?php
    $data = mysqli_query($conn, "select * from mahasiswa where nim='$user'");

    $row = mysqli_fetch_array($data);
    $nim = $row['nim'];

    if (isset($_POST['semester'])) {
        $semester = $_POST['semester'];

        $data2 = mysqli_query($conn, "select count(ket) as alfa from logabsen where ket='Alfa' and nim_mhs='$nim' and semester='$semester'");
        $data3 = mysqli_query($conn, "select count(ket) as izin from logabsen where ket='Izin' and nim_mhs='$nim' and semester='$semester'");
        $data4 = mysqli_query($conn, "select count(ket) as sakit from logabsen where ket='Sakit' and nim_mhs='$nim' and semester='$semester'");
    } else {
        $semester = $row['semester'];

        $data2 = mysqli_query($conn, "select count(ket) as alfa from logabsen where ket='Alfa' and nim_mhs='$nim' and semester='$semester'");
        $data3 = mysqli_query($conn, "select count(ket) as izin from logabsen where ket='Izin' and nim_mhs='$nim' and semester='$semester'");
        $data4 = mysqli_query($conn, "select count(ket) as sakit from logabsen where ket='Sakit' and nim_mhs='$nim' and semester='$semester'");
    }
    ?>

    <?php

    $izin = mysqli_fetch_assoc($data3);
    $alfa = mysqli_fetch_assoc($data2);
    $sakit = mysqli_fetch_assoc($data4); ?>
    <section>
        
    <div class="font1">    
    <h2>Selamat Datang <?php echo $row['nama']; ?> (<?php echo $row['nim']; ?>)</h2>
    </div>
    <br> 
    <form id="inputan" action="" method="post">
        <select name="semester" id="semester" onchange="submitForm()">
            <option selected values="">Pilih semester</option>
            <option value="1">Semester 1</option>
            <option value="2">Semester 2</option>
            <option value="3">Semester 3</option>
            <option value="4">Semester 4</option>
        </select>
    </form>
     <!-- Widget alfa -->
        <div class="card-body color2">
        <div class="float-right">
            <h3>
                <span class="count"><?php echo $alfa['alfa']; ?></span>
                <span>Pertemuan</span>
            </h3>      
        </div>
        <div class="float-left">
            <h1>Alfa</h1>
        </div>
        
    </div>
    <!-- Widget izin -->
        <div class="card-body color3">
        <div class="float-right">
            <h3>
                <span class="count"><?php echo $izin['izin']; ?></span>
                <span>Pertemuan</span>
            </h3>       
        </div>
        <div class="float-left">
            <h1>Izin</h1>
        </div>
        
    </div>
    <!-- Widget sakit -->
        <div class="card-body color4">
        <div class="float-right">
            <h3>
                <span class="count"><?php echo $sakit['sakit']; ?></span>
                <span>Pertemuan</span>
            </h3>    
        </div>
        <div class="float-left">
            <h1>Sakit</h1>
        </div>
        
    </div>

     <!-- Widget none
        <div class="card-body color1">
        <div class="float-right">
            <h3>
                <span class="count"><?php echo $sakit['sakit']; ?></span>
                <span>Pertemuan</span>
            </h3>
            <p align="right"><a>-</a></p>        
        </div>
        <div class="float-left">
            <h1>Sakit</h1>
        </div>
        
    </div>
    -->
    </section>
    <section>
        <div class="kompensasi">
         <p>KETERANGAN KETIDAKHADIRAN</p>   
         <table>
            <tr>
                <td>
                    <p>Alfa : <?php echo $alfa['alfa']; ?></p>
                </td>
                <td>
                    <p>Izin : <?php echo $izin['izin']; ?></p>
                </td>
                <td>
                    <p>Sakit : <?php echo $sakit['sakit']; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    $dataDet = mysqli_query($conn, "select * from logabsen where ket='Alfa' and nim_mhs='$nim'");
                    while ($row2 = mysqli_fetch_array($dataDet)) { ?>

                        <p>Pertemuan ke <?php echo $row2['pertemuan']; ?> tanggal <?php echo $row2['tanggal']; ?></p>
                    <?php } ?>
                </td>
                <td>
                    <?php
                    $dataDet = mysqli_query($conn, "select * from logabsen where ket='Izin' and nim_mhs='$nim'");
                    while ($row2 = mysqli_fetch_array($dataDet)) { ?>

                        <p>Pertemuan ke <?php echo $row2['pertemuan']; ?> tanggal <?php echo $row2['tanggal']; ?></p>
                    <?php } ?>
                </td>
                <td>
                    <?php
                    $dataDet = mysqli_query($conn, "select * from logabsen where ket='Sakit' and nim_mhs='$nim'");
                    while ($row2 = mysqli_fetch_array($dataDet)) { ?>

                        <p>Pertemuan ke <?php echo $row2['pertemuan']; ?> tanggal <?php echo $row2['tanggal']; ?></p>
                    <?php } ?>
                </td>
            </tr>

        </table>
            <div class="footer">
            <a href="?page=detail&id=<?php echo $row['nim']; ?>&smt=<?php echo $semester; ?>" class="btn btn-warning btn-sm">Detail</a>
            </div>
        </div>
        
            
        
    </section>
    

    <script type="text/javascript">
        $('.count').each(function(){
        $(this).prop('counter',0).animate({
            Counter: $(this).text()
            }, {
            duration:500,
            easing:'swing',
            step: function(now){
            $(this).text(Math.ceil(now));
            }
        });
     });    
    </script>

</body>

</html>