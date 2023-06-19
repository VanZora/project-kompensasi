<?php $page = "kompensasi";
include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="?page=set_kegiatan" class="btn btn-warning btn-sm">Tambahkan Kegiatan</a>

    <table class="table table-striped table-bordered border-dark-subtle">
        <tr>
            <td>DURASI KOMPENSASI</td>
            <td>PENGAWAS</td>
            <td>PROGRESS</td>
            <td>VALIDASI PENGAWAS</td>
            <td>VALIDASI ADMIN PRODI</td>
        </tr>

        <?php
        include '../function.php';
        session_start();
        $user = $_SESSION['user'];
        $data = mysqli_query($conn, "select kode_kompen, jml_jam, pengawas.nama, progress, v_pengawas, v_aprodi from 
        mhs_kompen INNER JOIN pengawas ON mhs_kompen.nik_pengawas = pengawas.nik where nim_mhs='$user'");



        while ($row = mysqli_fetch_array($data)) {

            $kode_kompen = $row['kode_kompen'];
            $data2 = mysqli_query($conn, "select * from mhs_kegiatan where kode_kompen='$kode_kompen' and nim_mhs='$user' and tuntas='belum'");
        ?>
            <tr>
                <td><?php echo $row['jml_jam']; ?> Jam</td>
                <td><?php echo $row['nama']; ?></td>
                <td><a href="?page=kegiatan&kd=<?php echo $row['kode_kompen']; ?>&usr=<?php echo $user; ?>"><?php if (mysqli_num_rows($data2) >= 1) {
                                                                                                                echo "Belum Selesai";
                                                                                                            } else {
                                                                                                                echo "Tuntas";
                                                                                                            } ?></a>
                <td><?php echo $row['v_pengawas']; ?></td>
                <td><?php echo $row['v_aprodi']; ?></td>
            </tr>
        <?php } ?>


    </table>
</body>

</html>