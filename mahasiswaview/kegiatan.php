<?php $page = "kompensasi";
include 'header.php';

require '../function.php';
if (isset($_POST["atur"])) {

    $alert = "<script>
    Swal.fire(
        'Berhasil!',
        'Progress telah disimpan!',
        'succes'
    )
            </script>";
    if (ubahKegiatan($_POST) > 0) {
        echo $alert;
    } else {
        echo $alert;
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
    <button class="btn btn-outline-secondary btn-sm" onclick="location.href='?page=kompensasi'"><i class='bx bx-arrow-back'></i></button><br><br>
    <form action="" method="post">
        <?php
        $nim = $_GET['usr'];
        $kode_kompen = $_GET['kd'];

        $datax = mysqli_query($conn, "select * from mhs_kompen where nim_mhs='$nim' and kode_kompen='$kode_kompen'");
        $isi = mysqli_fetch_assoc($datax);

        $total_potong = $isi['jml_jam'];
        ?>
        
        <table class="table border-light-subtle">
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
                    <td><textarea name="<?php echo 'kegiatan' . strval($input); ?>"><?php echo $row['kegiatan']; ?></textarea></td>
                    <td><input type="number" name="<?php echo 'durasi' . strval($input); ?>" value="<?php echo $row['durasi']; ?>"></td>
                    <td><input name="<?php echo 'tuntas' . strval($input); ?>" type="hidden" value="<?php if ($row['tuntas'] == 'ya') {
                                                                                                        echo 'Diverifikasi';
                                                                                                    } else {
                                                                                                        echo '';
                                                                                                    } ?>">
                        <p><?php if ($row['tuntas'] == 'ya') {
                                echo 'Diverifikasi';
                            } else {
                                echo 'Belom';
                            } ?></p>
                    </td>
                </tr>

            <?php $input++;
            } ?>
        </table>
        <p>Sisa waktu pengerjaan : <?php echo $total_potong; ?></p>
        
        <input type="hidden" name="wkt" value="<?php echo $total_potong; ?>">
        <input type="hidden" name="usr" value="<?php echo $nim; ?>">
        <input type="hidden" name="kd" value="<?php echo $kode_kompen; ?>">

        <div class="d-grid gap-2">
            <input type="submit" name="atur" value="Simpan" class="btn btn-outline-primary btn-sm" type="button">
        </div>
    </form>

</body>

</html>