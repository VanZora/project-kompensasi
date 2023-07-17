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
    <form id="inputan" action="" method="post">
        <select name="semester" id="semester" onchange="submitForm()" class="form-select form-select-sm" aria-label=".form-select-sm example">
            <option selected values="">Pilih semester</option>
            <option value="1">Semester 1</option>
            <option value="2">Semester 2</option>
            <option value="3">Semester 3</option>
            <option value="4">Semester 4</option>
        </select>
    </form>

    <?php
    include '../function.php';
    $user = $_SESSION['user'];
    $ambil = mysqli_query($conn, "select * from mahasiswa where nim='$user'");
    $target = mysqli_fetch_assoc($ambil);

    if (isset($_POST['semester'])) {
        $semester = $_POST['semester'];
        $data = mysqli_query($conn, "select mhs_kompen.kode_kompen as kd_mahasiswa, admin_kompen.semester, tempat.nama as tempat, jml_jam, pengawas.nama, v_pengawas, v_aprodi from 
            mhs_kompen INNER JOIN pengawas ON mhs_kompen.nik_pengawas = pengawas.nik
            INNER JOIN admin_kompen ON mhs_kompen.kode_kompen = admin_kompen.kode_kompen 
            INNER JOIN tempat ON admin_kompen.kode_ruang = tempat.kode_ruang where nim_mhs='$user' and admin_kompen.semester='$semester'");
    } else {
        $semester = $target['semester'];
        $data = mysqli_query($conn, "select mhs_kompen.kode_kompen as kd_mahasiswa, admin_kompen.semester, tempat.nama as tempat, jml_jam, pengawas.nama, v_pengawas, v_aprodi from 
            mhs_kompen INNER JOIN pengawas ON mhs_kompen.nik_pengawas = pengawas.nik 
            INNER JOIN admin_kompen ON mhs_kompen.kode_kompen = admin_kompen.kode_kompen
            INNER JOIN mahasiswa ON mhs_kompen.nim_mhs = mahasiswa.nim 
            INNER JOIN tempat ON admin_kompen.kode_ruang = tempat.kode_ruang where nim_mhs='$user' and admin_kompen.semester = mahasiswa.semester");
    } ?>

    <?php
    if (mysqli_num_rows($data) >= 1) {
        echo '<a href="suratkompensasi.php?smt='. $semester . '" target=" _blank" class="btn btn-success btn-sm"><i class="bx bxs-printer"></i> Cetak Keterangan Kompensasi</a>';
    } else {
        echo '<button class="btn btn-success btn-sm" disabled><i class="bx bxs-printer"></i> Cetak Keterangan Kompensasi</button>';
    }
    ?>
    <br><br>
    <table class="table table-striped table-bordered border-dark-subtle">
        <tr>
            <td>SEMESTER</td>
            <td>DURASI KOMPENSASI</td>
            <td>PENGAWAS</td>
            <td>TEMPAT</td>
            <td>PROGRESS</td>
            <td>VALIDASI PENGAWAS</td>
            <td>VALIDASI ADMIN PRODI</td>
        </tr>

        <?php
        while ($row = mysqli_fetch_array($data)) {

            $kode_kompen = $row['kd_mahasiswa'];
            $data2 = mysqli_query($conn, "select * from mhs_kegiatan where kode_kompen='$kode_kompen' and nim_mhs='$user' and tuntas='belum'");
        ?>
            <tr>
                <td><?php echo $row['semester']; ?></td>
                <td><?php echo $row['jml_jam']; ?> Jam</td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['tempat']; ?></td>
                <td><a href="?page=kegiatan&kd=<?php echo $row['kd_mahasiswa']; ?>&usr=<?php echo $user; ?>"><?php if (mysqli_num_rows($data2) >= 1) {
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