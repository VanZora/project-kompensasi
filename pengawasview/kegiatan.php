<?php $page = "dashboard";
include 'header.php';

require '../function.php';
if (isset($_POST["acc"])) {

    if (validasiPengawas($_POST) > 0) {
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

    if (cancelPengawas($_POST) > 0) {
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
if (isset($_POST["atur"])) {

    $alert = "<script>
    Swal.fire(
        'Berhasil!',
        'Berhasil Diubah!',
        'success'
    )
    </script>";
    if (ubahKegiatan($_POST) > 0) {
        echo $alert;
    } else
        echo $alert;
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
    <button class="btn btn-outline-secondary btn-sm" onclick="history.back()"><i class='bx bx-arrow-back'></i></button><br><br>
    <form action="" method="post">
        <?php
        $nim = $_GET['nim'];
        $kode_kompen = $_GET['kd'];

        $datax = mysqli_query($conn, "select * from mhs_kompen where nim_mhs='$nim' and kode_kompen='$kode_kompen'");
        $isi = mysqli_fetch_assoc($datax);

        $total_potong = $isi['jml_jam'];
        ?>
        <table class="table border-light-subtle ">
            <tr>
                <th>PENGERJAAN</th>
                <th>KEGIATAN</th>
                <th>DURASI (JAM)</th>
                <th>VERIFIKASI PENGAWAS</th>
            </tr>

            <?php
            $data = mysqli_query($conn, "select * from mhs_kegiatan where nim_mhs='$nim' and kode_kompen='$kode_kompen'");
            $input = 0;
            while ($row = mysqli_fetch_array($data)) { 
                $total_potong -= $row['durasi'];
                ?>
                <tr>
                    <td>Hari <?php echo $input + 1; ?></td>
                    <td><textarea name="<?php echo 'kegiatan' . strval($input); ?>" type="text"><?php echo $row['kegiatan']; ?></textarea></td>
                    <td><input type="number" name="<?php echo 'durasi' . strval($input); ?>" value="<?php echo $row['durasi']; ?>"></td>
                    <td><input name="<?php echo 'tuntas' . strval($input); ?>" type="checkbox" <?php if ($row['tuntas'] == "ya") {
                                                                                                    echo "checked";
                                                                                                } ?>></td>
                </tr>
            <?php $input++;
            } ?>
        </table>
        <p>Sisa waktu pengerjaan : <?php echo $total_potong; ?></p>

        <?php
        $data = mysqli_query($conn, "select * from mhs_kompen where nim_mhs='$nim' and kode_kompen='$kode_kompen'");
        $row = mysqli_fetch_assoc($data);
        $ket = "Validasi Pengawas";
        $valid = "acc";
        $warna = "btn-success";
        if ($row['v_pengawas'] == "VALID") {
            $ket = "Batalkan Validasi";
            $valid = "cancel";
            $warna = "btn-secondary";
        }
        ?>
        <input type="hidden" name="wkt" value="<?php echo $total_potong; ?>">
        <input type="hidden" name="usr" value="<?php echo $nim; ?>">
        <input type="hidden" name="nim" value="<?php echo $nim; ?>">
        <input type="hidden" name="kd" value="<?php echo $kode_kompen; ?>">

        <?php
        $data = mysqli_query($conn, "select * from mhs_kegiatan where nim_mhs='$nim' and kode_kompen='$kode_kompen'")
        ?>
        <!-- <div class="d-grid gap-2"">
            <input type="submit" name="<?php echo $valid; ?>" value="<?php echo $ket; ?>" class="btn <?php echo $warna; ?> btn-sm">
        </div><br> -->
        <div class="d-grid gap-2"">
            <input type="submit" name="atur" value="Simpan" class="btn btn-primary btn-sm">
        </div>
    </form>

</body>

</html>