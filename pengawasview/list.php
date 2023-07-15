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

    <table id="example" class="table table-striped border-light-subtle">
        <thead>
            <tr>
                <th>NIM</th>
                <th>NAMA</th>
                <th>WAKTU PENGERJAAN</th>
                <th>PROGRESS</th>
            </tr>
        </thead>

        <tbody>
        <button class="btn btn-outline-secondary btn-sm" onclick="history.back()"><i class='bx bx-arrow-back' ></i></button><br><br>
            <?php
            include '../function.php';
            $kode_kompen = $_GET['kd'];

            $data = mysqli_query($conn, "select mahasiswa.nim, mahasiswa.nama, kode_kompen, jml_jam 
        from mhs_kompen INNER JOIN mahasiswa ON mhs_kompen.nim_mhs = mahasiswa.nim 
        where mhs_kompen.kode_kompen='$kode_kompen'");

            while ($row = mysqli_fetch_array($data)) {
                $nim = $row['nim'];
                $kode_kompen2 = $row['kode_kompen'];
                $data2 = mysqli_query($conn, "select * from mhs_kegiatan where kode_kompen='$kode_kompen2' and nim_mhs='$nim' and tuntas='belum'");
            ?>
                <tr>
                    <td><?php echo $row['nim']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['jml_jam']; ?></td>
                    <td><a href="?page=kegiatan&kd=<?php echo $row['kode_kompen']; ?>&nim=<?php echo $nim; ?>"><?php if (mysqli_num_rows($data2) >= 1) {
                                                                                                                    echo "Belum Selesai";
                                                                                                                } else {
                                                                                                                    echo "Selesai";
                                                                                                                } ?></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>