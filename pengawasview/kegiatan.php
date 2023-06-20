<?php $page = "dashboard";
include 'header.php';

require '../function.php';
if (isset($_POST["acc"])) {

    if (validasiPengawas($_POST) > 0) {
        echo "<script>
                    alert('Berhasil Disimpan');
                    </script>";
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
    <form action="" method="post">
        <table class="table table-striped table-bordered border-dark-subtle">
            <tr>
                <td>KEGIATAN</td>
                <td>TUNTAS</td>
            </tr>

            <?php
            $nim = $_GET['nim'];
            $kode_kompen = $_GET['kd'];

            $data = mysqli_query($conn, "select * from mhs_kegiatan where nim_mhs='$nim' and kode_kompen='$kode_kompen'");
            $input = 0;
            while ($row = mysqli_fetch_array($data)) { ?>
                <tr>
                    <td><input name="<?php echo 'kegiatan' . strval($input); ?>" type="text" value="<?php echo $row['kegiatan']; ?>" readonly></td>
                    <td><input name="<?php echo 'tuntas' . strval($input); ?>" type="checkbox" <?php if ($row['tuntas'] == "ya") {
                                                                                                    echo "checked";
                                                                                                } ?> disabled></td>
                </tr>
            <?php $input++;
            } ?>
        </table>

        <input type="hidden" name="nim" value="<?php echo $nim; ?>">
        <input type="hidden" name="kd" value="<?php echo $kode_kompen; ?>">

        <?php 
        $data = mysqli_query($conn, "select * from mhs_kegiatan where nim_mhs='$nim' and kode_kompen='$kode_kompen'")
        ?>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <input type="submit" name="acc" value="Validasi Pengawas" class="btn btn-secondary" type="button">
            <a href="?page=jadwalpage" class="btn btn-outline-secondary"> Kembali</a>
        </div>
    </form>

</body>

</html>