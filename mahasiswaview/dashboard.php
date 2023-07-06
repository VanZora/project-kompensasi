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

    $tuntas = mysqli_query($conn, "select * from mhs_kompen where nim_mhs='$user' and (v_pengawas='-' or v_aprodi='-')");
    $waktu = mysqli_query($conn, "select * from admin_kompen INNER JOIN mhs_kompen ON admin_kompen.kode_kompen = mhs_kompen.kode_kompen where mhs_kompen.nim_mhs='$user'");
    $tenggat = mysqli_fetch_assoc($waktu);

    if (mysqli_num_rows($tuntas) == 1) {
        echo '<div class="alert alert-danger">
        <strong>Kompensasi belum tuntas !</strong> kamu harus menyelesaikan kompensasi sebelum tanggal ' . $tenggat['waktu'] . '  <a style="text-decoration:underline ;" href="?page=kompensasi" class="alert-link">Klik disini !</a>.
        </div>';
    } else {
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

    <div class="row">
        <div class="col">
            <td>
                <blockquote class="quote-info mt-0 bayangan">
                    <h5 id="tip">Selamat Datang! </h5>
                    <p><?php echo $row['nama']; ?> : <?php echo $row['nim']; ?> </p>
                </blockquote>
            </td>
        </div>
        <div class="col">
            <td>
                <blockquote class="quote-orange mt-0 bayangan">
                    <h5 id="tip">Tanggal Hari Ini </h5>
                    <p><?php echo date("Y/m/d") . "<br>"; ?> </p>
                </blockquote>
            </td>
        </div>
    </div>
    <br>
    <form id="inputan" action="" method="post">
        <select name="semester" id="semester" class="form-select form-select-sm" onchange="submitForm()">
            <option selected values="">Pilih semester</option>
            <option value="1">Semester 1</option>
            <option value="2">Semester 2</option>
            <option value="3">Semester 3</option>
            <option value="4">Semester 4</option>
        </select>
    </form>

    <!-- Widget alfa -->
    <a href="?page=detail&id=<?php echo $row['nim']; ?>&smt=<?php echo $semester; ?>" class="btn btn-warning btn-sm">Detail</a>
    <br><br>
    <div class="row">
        <div class="col">
            <div class="card text-white bg-danger mb-3" style="max-width: 25rem;">
                <div class="card-header">Alfa</div>
                <div class="card-body">
                    <h5 class="card-title">Total Alfa :</h5>
                    <h3 class="card-text"><?php echo $alfa['alfa']; ?></h3>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-warning mb-3" style="max-width: 25rem;">
                <div class="card-header">Izin</div>
                <div class="card-body">
                    <h5 class="card-title">Total Izin :</h5>
                    <h3 class="card-text"><?php echo $izin['izin']; ?></h3>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-success mb-3" style="max-width: 25rem;">
                <div class="card-header">Sakit</div>
                <div class="card-body">
                    <h5 class="card-title">Total Sakit :</h5>
                    <h3 class="card-text"><?php echo $sakit['sakit']; ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card border-danger mb-3" style="max-width: 25rem;">
                <div class="card-header">Tanggal Alfa</div>
                <div class="card-body text-secondary">
                    <?php
                    $dataDet = mysqli_query($conn, "select * from logabsen where ket='Alfa' and nim_mhs='$nim' and semester='$semester'");
                    while ($row2 = mysqli_fetch_array($dataDet)) { ?>

                        <b>Tanggal <?php echo $row2['tanggal']; ?></b><br>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-warning mb-3" style="max-width: 25rem;">
                <div class="card-header">Tanggal Izin</div>
                <div class="card-body text-secondary">
                    <?php
                    $dataDet = mysqli_query($conn, "select * from logabsen where ket='Izin' and nim_mhs='$nim' and semester='$semester'");
                    while ($row2 = mysqli_fetch_array($dataDet)) { ?>

                        <b>Tanggal <?php echo $row2['tanggal']; ?></b><br>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-success mb-3" style="max-width: 25rem;">
                <div class="card-header">Tanggal Sakit</div>
                <div class="card-body text-secondary">
                    <?php
                    $dataDet = mysqli_query($conn, "select * from logabsen where ket='Sakit' and nim_mhs='$nim' and semester='$semester'");
                    while ($row2 = mysqli_fetch_array($dataDet)) { ?>

                        <b>Tanggal <?php echo $row2['tanggal']; ?></b><br>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>