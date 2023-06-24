<?php $page = "kompensasi";
include 'header.php';

require '../function.php';
if (isset($_POST["kode_kompen"])) {

    echo "asasasa";
    if (deleteKompen($_POST) > 0)
        header("location:?page=kompensasi");
    else
        echo mysqli_error($conn);
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
    <div class="d-grid gap-2">
        <a href="?page=set_kegiatan" class="btn btn-outline-secondary btn-sm">Tambahkan Kegiatan</a>
    </div><br>

    <form action="" method="post">
        <table id="example" class="table table-striped table-bordered border-light-subtle table-sm">
            <thead>
                <tr>
                    <th>KODE KOMPENSASI</th>
                    <th>SEMESTER</th>
                    <th>PRODI</th>
                    <th>KELAS</th>
                    <th>JUMLAH MAHASISWA</th>
                    <th>PENGAWAS</th>
                    <th>TEMPAT</th>
                    <th>TANGGAL</th>
                    <th>Progress</th>
                    <th>AKSI</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $data = mysqli_query($conn, "select kode_kompen, prodi, semester, kelas, jml_mhs, pengawas.nama, tempat, tanggal, waktu, progress from admin_kompen INNER JOIN pengawas ON admin_kompen.nik_pengawas = pengawas.nik");

                while ($row = mysqli_fetch_array($data)) { ?>
                    <tr>
                        <td><?php echo $row['kode_kompen']; ?></td>
                        <td><?php echo $row['semester']; ?></td>
                        <td><?php echo $row['prodi']; ?></td>
                        <td><?php echo $row['kelas']; ?></td>
                        <td><?php echo $row['jml_mhs']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['tempat']; ?></td>
                        <td><?php echo $row['tanggal']; ?></td>
                        <td><a href="?page=progress&kd=<?php echo $row['kode_kompen']; ?>"><?php echo $row['progress']; ?> </a></td>
                        <td><span>
                                <input type="hidden" name="kode" value="<?php echo $row['kode_kompen']; ?>">
                                <button name="kode_kompen" type="submit" class="btn btn-danger">
                                    <i class="bx bx-trash"></i>
                                </button></span></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
</body>

</html>