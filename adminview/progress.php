<?php $page = "kompensasi";
include 'header.php';
include '../function.php';
if (isset($_POST["acc"])) {

    if (validasiAdmin($_POST) > 0) {
        echo "<script>
        Swal.fire(
            'Berhasil!',
            'Kegiatan telah divalidasi!',
            'success'
        )
        </script>";
    } else
        echo mysqli_error($conn);
}
if (isset($_POST["cancel"])) {

    if (cancelAdmin($_POST) > 0) {
        echo "<script>
        Swal.fire(
            'Peringatan!',
            'Validasi kegiatan dibatalkan!',
            'warning'
        )
        </script>";
    } else
        echo mysqli_error($conn);
}
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
    <button class="btn btn-outline-secondary btn-sm" onclick="location.href='?page=kompensasi';"><i class='bx bx-arrow-back'></i></button><br><br>
    <?php
    $kode_kompen = $_GET['kd'];

    $pengawas = mysqli_query($conn, "select pengawas.nik, pengawas.nama, pengawas.jurusan, kode_kompen from tgs_pengawas INNER JOIN pengawas ON tgs_pengawas.nik_pengawas = pengawas.nik where tgs_pengawas.kode_kompen='$kode_kompen'");
    $mahasiswa = mysqli_query($conn, "select distinct v_aprodi from mhs_kompen where kode_kompen='$kode_kompen'");

    $rowz = mysqli_fetch_assoc($pengawas);
    $rowx = mysqli_fetch_assoc($mahasiswa);

    $ket = "Validasi Admin Prodi";
    $valid = "acc";
    $warna = "btn-success";
    if ($rowx['v_aprodi'] == "ACC") {
        $ket = "Batalkan Validasi";
        $valid = "cancel";
        $warna = "btn-secondary";
    }
    ?>

    <table>
        <tr>
            <td>Pengawas</td>
            <th>: <?php echo $rowz['nama']; ?></th>
        </tr>
        <tr>
            <td>Prodi</td>
            <th>: <?php echo $rowz['jurusan'] ?></th>
        </tr>
        <tr>
            <td>Kelas</td>
            <th>: AXioo</th>
        </tr>
        
    </table><br>
    <a href="" target=" _blank" class="btn btn-success btn-sm"><i class="bx bxs-printer"></i> Cetak</a><br>
    <form action="" method="post">
        <div class="d-grid gap-2">
            <input type="hidden" name="kd" value="<?php echo $rowz['kode_kompen']; ?>">
            <button name="<?php echo $valid; ?>" class="btn <?php echo $warna; ?> btn-sm"><?php echo $ket; ?></button>
        </div><br>
    </form>
    <table id="example" class="table table-striped table-bordered border-light-subtle">
        <thead>
            <tr>
                <td>NAMA</td>
                <td>WAKTU PENGERJAAN</td>
                <td>PROGRESS</td>
            </tr>
        </thead>

        <tbody>
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
                    <td><?php if (mysqli_num_rows($data2) >= 1) {
                            echo "Belum Selesai";
                        } else {
                            echo "Tuntas";
                        } ?>
                        <?php if (mysqli_num_rows($data3) >= 1) {
                            echo " (Tervalidasi)";
                        } else {
                            echo "";
                        } ?>
                    </td>
                </tr>
            <?php } ?>
    </table>
    </tbody>
</body>

</html>