<?php $page = "kompensasi";
include 'header.php';

require '../function.php';
if (isset($_POST["kode_kompen"])) {

    if (deleteKompen($_POST) > 0) {
        header("location:?page=kompensasi");
    } else {
        echo mysqli_error($conn);
    }
}
?>

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
            <td>KODE KOMPENSASI</td>
            <td>SEMESTER</td>
            <td>KELAS</td>
            <td>JUMLAH MAHASISWA</td>
            <td>PENGAWAS</td>
            <td>TEMPAT</td>
            <td>WAKTU</td>
            <td>TANGGAL</td>
            <td>Progress</td>
            <td>AKSI</td>
        </tr>

        <?php
        $data = mysqli_query($conn, "select kode_kompen, semester, kelas, jml_mhs, pengawas.nama, tempat, tanggal, waktu, progress from admin_kompen INNER JOIN pengawas ON admin_kompen.nik_pengawas = pengawas.nik");

        while ($row = mysqli_fetch_array($data)) { ?>
            <form action="" method="post">
                <tr>
                    <td><?php echo $row['kode_kompen']; ?></td>
                    <td><?php echo $row['semester']; ?></td>
                    <td><?php echo $row['kelas']; ?></td>
                    <td><?php echo $row['jml_mhs']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['tempat']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><?php echo $row['waktu']; ?></td>
                    <td><?php echo $row['progress']; ?></td>
                    <td><span>
                        <input type="hidden" name="kode" value="<?php echo $row['kode_kompen']; ?>">
                        <button name="kode_kompen" type="submit" class="btn btn-danger">
                            <i class="bx bx-trash"></i>
                        </button></span></td>

                </tr>
            </form>
        <?php } ?>


    </table>
</body>

</html>