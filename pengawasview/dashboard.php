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
            <td>SEMESTER</td>
            <td>KELAS</td>
            <td>JUMLAH MAHASISWA</td>
            <td>TEMPAT</td>
            <td>TANGGAL</td>
            <td>WAKTU</td>
            <td>PROGRESS</td>
            <td>AKSI</td>
        </tr>

        <?php
        include "../function.php";
        session_start();
        $user = $_SESSION["user"];
        $data = mysqli_query($conn, "select * from tgs_pengawas where nik_pengawas='$user'");

        while ($row = mysqli_fetch_array($data)) { ?>
            <tr>
                <td><?php echo $row['semester']; ?></td>
                <td><?php echo $row['kelas']; ?></td>
                <td><?php echo $row['jml_mhs']; ?></td>
                <td><?php echo $row['tempat']; ?></td>
                <td><?php echo $row['tanggal']; ?></td>
                <td><?php echo $row['waktu']; ?></td>
                <td><?php echo $row['progress']; ?></td>
                <td><a href="?page=list&smt=<?php echo $row['semester']; ?>&kls=<?php echo $row['kelas']; ?>" class="btn btn-warning btn-sm">List Mahasiswa</a></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>