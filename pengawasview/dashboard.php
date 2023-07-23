<?php $page = "dashboard";
include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include "../function.php";

    $user = $_SESSION["user"];
    $datax = mysqli_query($conn, "select * from pengawas where nik='$user'");
    $deteksi = mysqli_query($conn, "select * from tgs_pengawas where nik_pengawas='$user'");
    $row = mysqli_fetch_assoc($datax);

    $nik = $row['nik'];
    ?>
    <div class="row">
        <div class="col">
            <td>
                <blockquote class="quote-info mt-0 bayangan">
                    <h5 id="tip">Selamat Datang! </h5>
                    <p><?php echo $row['nama']; ?> : <?php echo $row['nik']; ?> </p>
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

    <form id="inputan" action="" method="post">
        <select name="periode" id="periode" class="form-select form-select-sm" onchange="submitForm()">
            <?php if (isset($_POST['periode'])) {
                $periode = $_POST['periode'];
                echo '<option selected values=""> Tahun Ajaran ' . $periode . '</option>';
            } else {
                '<option selected values="">Periode</option>';
            } ?>

            <option value="2022 - 2023 Genap">Tahun Ajaran 2022 - 2023 Genap</option>
            <option value="2022 - 2023 Ganjil">Tahun Ajaran 2022 - 2023 Ganjil</option>
            <option value="2021 - 2022 Genap">Tahun Ajaran 2021 - 2022 Genap</option>
            <option value="2021 - 2022 Ganjil">Tahun Ajaran 2021 - 2022 Ganjil</option>
        </select>
    </form>
    <?php
    if (mysqli_num_rows($deteksi) >= 1) {
        echo '<a href="suratkompensasi.php?nik=' . $nik . '" target=" _blank" class="btn btn-danger btn-sm"><i class="bx bxs-printer"></i> Surat Penugasan Kompensasi</a><br><br>';
    }
    ?>
    <table id="example" class="table table-striped table-bordered border-light-subtle">
        <thead>
            <tr>
                <th>KODE</th>
                <th>SEMESTER</th>
                <th>KELAS</th>
                <th>JUMLAH MAHASISWA</th>
                <th>TEMPAT</th>
                <th>TANGGAL</th>
                <th>WAKTU</th>
                <th>PROGRESS</th>
                <th>AKSI</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (isset($_POST['periode'])) {
                $periode = $_POST['periode'];
                $data = mysqli_query($conn, "select tgs_pengawas.*, tempat.nama as tempatx from tgs_pengawas INNER JOIN admin_kompen ON admin_kompen.kode_kompen = tgs_pengawas.kode_kompen
                INNER JOIN tempat ON admin_kompen.kode_ruang = tempat.kode_ruang where tgs_pengawas.nik_pengawas='$user' and admin_kompen.periode='$periode'");
            } else {
                $data = mysqli_query($conn, "select tgs_pengawas.*, tempat.nama as tempatx from tgs_pengawas INNER JOIN admin_kompen ON admin_kompen.kode_kompen = tgs_pengawas.kode_kompen
                INNER JOIN tempat ON admin_kompen.kode_ruang = tempat.kode_ruang where tgs_pengawas.nik_pengawas='$user' and admin_kompen.periode='2022 - 2023 Genap'");
            }
            
            $tuntas = mysqli_query($conn, "select * from mhs_kompen where nik_pengawas='$user' and v_pengawas='-'");

            while ($row = mysqli_fetch_array($data)) { ?>
                <tr>
                    <td><?php echo $row['kode_kompen']; ?></td>
                    <td><?php echo $row['semester']; ?></td>
                    <td><?php echo $row['kelas']; ?></td>
                    <td><?php echo $row['jml_mhs']; ?></td>
                    <td><?php echo $row['tempatx']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><?php echo $row['waktu']; ?></td>
                    <td><?php if (mysqli_num_rows($tuntas) >= 1) {
                            echo "Belum selesai";
                        } else {
                            echo "Selesai";
                        } ?></td>
                    <td><a href="?page=list&kd=<?php echo $row['kode_kompen']; ?>" class="btn btn-warning btn-sm">List Mahasiswa</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>