<?php $page = "dashboard";
include 'header.php'; ?>
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
        include '../function.php';
        $kode_kompen = $_GET['kd'];

        $pengawas = mysqli_query($conn, "select pengawas.nik, pengawas.nama, kode_kompen from tgs_pengawas INNER JOIN pengawas ON tgs_pengawas.nik_pengawas = pengawas.nik where tgs_pengawas.kode_kompen='$kode_kompen'");
        $rowz = mysqli_fetch_assoc($pengawas);
    ?>

    <h1><?php echo $rowz['nama']; ?></h1>
    <table class="table table-striped table-bordered border-dark-subtle">
        <tr>
            <td>NAMA</td>
            <td>WAKTU PENGERJAAN</td>
            <td>PROGRESS</td>
        </tr>

        <?php
        
        

        $data = mysqli_query($conn, "select mahasiswa.nim, mahasiswa.nama, kode_kompen, jml_jam from mhs_kompen INNER JOIN mahasiswa ON mhs_kompen.nim_mhs = mahasiswa.nim where mhs_kompen.kode_kompen='$kode_kompen'");

        while ($row = mysqli_fetch_array($data)) {

            $nim = $row['nim'];
            $kode_kompen2 = $row['kode_kompen'];
            $data2 = mysqli_query($conn, "select * from mhs_kegiatan where kode_kompen='$kode_kompen2' and nim_mhs='$nim' and tuntas='belum'");
            $data3 = mysqli_query($conn, "select * from mhs_kompen where kode_kompen='$kode_kompen2' and nim_mhs='$nim' and v_pengawas='ACC'");
        ?>
            <tr>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['jml_jam']; ?></td>
                <td><a href="?page=kegiatan&kd=<?php echo $row['kode_kompen']; ?>&nim=<?php echo $nim; ?>"><?php if (mysqli_num_rows($data2) >= 1) {
                                                                                                                echo "Belum Selesai";
                                                                                                            } else {
                                                                                                                echo "Tuntas";
                                                                                                            } ?></a>
                    <?php if (mysqli_num_rows($data3) >= 1) {
                        echo " (Tervalidasi)";
                    } else {
                        echo "";
                    } ?>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>

</html>