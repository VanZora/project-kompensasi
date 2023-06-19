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

    <table class="table table-striped table-bordered border-dark-subtle">
        <tr>
            <td>NAMA</td>
            <td>WAKTU PENGERJAAN</td>
            <td>PROGRESS</td>
        </tr>

        <?php
        include '../function.php';
        $semester = $_GET['smt'];
        $kelas = $_GET['kls'];

        $data = mysqli_query($conn, "select mahasiswa.nim, mahasiswa.nama, kode_kompen, jml_jam from mhs_kompen INNER JOIN mahasiswa ON mhs_kompen.nim_mhs = mahasiswa.nim where mahasiswa.semester='$semester' and mahasiswa.kelas='$kelas'");

        while ($row = mysqli_fetch_array($data)) {

            $nim = $row['nim'];
            $kode_kompen = $row['kode_kompen'];
            $data2 = mysqli_query($conn, "select * from mhs_kegiatan where kode_kompen='$kode_kompen' and nim_mhs='$nim' and tuntas='belum'");
        ?>
            <tr>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['jml_jam']; ?></td>
                <td><?php if (mysqli_num_rows($data2) >= 1) {
                        echo "Belum Selesai";
                    } else {
                        echo "Tuntas";
                    } ?></td>
            </tr>
        <?php } ?>
    </table>

</body>

</html>