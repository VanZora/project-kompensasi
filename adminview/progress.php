<?php $page = "kompensasi";
include 'header.php';
include '../function.php';

$kvalid = "<script>
Swal.fire(
    'Berhasil!',
    'Kegiatan telah divalidasi!',
    'success'
)
</script>";

$kbatal = "<script>
Swal.fire(
    'Peringatan!',
    'Validasi kegiatan dibatalkan!',
    'warning'
)
</script>";

if (isset($_POST["accx"])) {

    if (validasiKaprodiAll($_POST) > 0) {
        echo $kvalid;
    } else
        echo mysqli_error($conn);
}
if (isset($_POST["cancelx"])) {

    if (cancelKaprodiAll($_POST) > 0) {
        echo $kbatal;
    } else
        echo mysqli_error($conn);
}

if (isset($_POST["accy"])) {

    if (validasiKalabAll($_POST) > 0) {
        echo $kvalid;
    } else
        echo mysqli_error($conn);
}
if (isset($_POST["cancely"])) {

    if (cancelKalabAll($_POST) > 0) {
        echo $kbatal;
    } else
        echo mysqli_error($conn);
}

if (isset($_GET["nimkl"]) && isset($_GET["kd"]) && isset($_GET["k"])) {

    if (validasiKalab($_GET) > 0)
        header("location:?page=progress&kd=" . $_GET["kd"]);
    else
        echo mysqli_error($conn);
}

if (isset($_GET["nimkpr"]) && isset($_GET["kd"]) && isset($_GET["k"])) {

    if (validasiKaprodi($_GET) > 0)
        header("location:?page=progress&kd=" . $_GET["kd"]);
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
    $pengawas = mysqli_query($conn, "select pengawas.nama, admin_kompen.kode_kompen, admin_kompen.kelas from admin_kompen INNER JOIN pengawas ON admin_kompen.nik_pengawas = pengawas.nik where admin_kompen.kode_kompen = '$kode_kompen'");
    $mahasiswax = mysqli_query($conn, "select distinct v_aprodi from mhs_kompen where kode_kompen='$kode_kompen'");
    $mahasisway = mysqli_query($conn, "select distinct v_pengawas from mhs_kompen where kode_kompen='$kode_kompen'");

    $rowz = mysqli_fetch_assoc($pengawas);
    $rowx = mysqli_fetch_assoc($mahasiswax);
    $rowy = mysqli_fetch_assoc($mahasisway);

    $ketx = "Validasi Kaprodi";
    $validx = "accx";
    $warnax = "btn-success";
    if ($rowx['v_aprodi'] == "VALID") {
        $ketx = "Batalkan Validasi Kaprodi";
        $validx = "cancelx";
        $warnax = "btn-secondary";
    }

    $kety = "Validasi Kalab";
    $validy = "accy";
    $warnay = "btn-success";
    if ($rowy['v_pengawas'] == "VALID") {
        $kety = "Batalkan Validasi Kalab";
        $validy = "cancely";
        $warnay = "btn-secondary";
    }

    ?>
    <table>
        <tr>
            <td>Pengawas</td>
            <th>: <?php echo $rowz['nama']; ?></th>
        </tr>
        <tr>
            <td>Kelas</td>
            <th>: <?php echo $rowz['kelas']; ?></th>
        </tr>

    </table><br>
    <a href="" target=" _blank" class="btn btn-primary btn-sm"><i class="bx bxs-printer"></i> Cetak</a><br><br>
    <form action="" method="post">
        <div class="d-grid gap-2">
            <input type="hidden" name="kd" value="<?php echo $rowz['kode_kompen']; ?>">
            <button name="<?php echo $validx; ?>" class="btn <?php echo $warnax; ?> btn-sm"><?php echo $ketx; ?></button>
        </div><br>
        <div class="d-grid gap-2">
            <input type="hidden" name="kd" value="<?php echo $rowz['kode_kompen']; ?>">
            <button name="<?php echo $validy; ?>" class="btn <?php echo $warnay; ?> btn-sm"><?php echo $kety; ?></button>
        </div><br>
    </form>
    <table id="example" class="table table-striped table-bordered border-light-subtle">
        <thead>
            <tr>
                <td>NAMA</td>
                <td>WAKTU PENGERJAAN</td>
                <td>PROGRESS</td>
                <td>VALIDASI</td>
            </tr>
        </thead>

        <tbody>
            <?php
            $data = mysqli_query($conn, "select mahasiswa.nim, mahasiswa.nama, kode_kompen, jml_jam from mhs_kompen INNER JOIN mahasiswa ON mhs_kompen.nim_mhs = mahasiswa.nim where mhs_kompen.kode_kompen='$kode_kompen'");

            while ($row = mysqli_fetch_array($data)) {

                $nim = $row['nim'];
                $kode_kompen2 = $row['kode_kompen'];
                $data2 = mysqli_query($conn, "select * from mhs_kegiatan where kode_kompen='$kode_kompen2' and nim_mhs='$nim' and tuntas='belum'");
                $data3 = mysqli_query($conn, "select * from mhs_kompen where kode_kompen='$kode_kompen2' and nim_mhs='$nim' and v_pengawas='VALID'");
                $data4 = mysqli_query($conn, "select * from mhs_kompen where kode_kompen='$kode_kompen2' and nim_mhs='$nim' and v_aprodi='VALID'");

                $text1 = "Belum Selesai";
                if (mysqli_num_rows($data2) >= 1) {
                } else {
                    $text1 = "Tuntas";
                }

                $warna2 = "btn-secondary";
                $text2 = "(Tervalidasi)";
                $keputusan = "1";
                if (mysqli_num_rows($data3) >= 1) {
                } else {
                    $warna2 = "btn-success";
                    $text2 = "";
                    $keputusan = "2";
                }

                $warna3 = "btn-secondary";
                $text3 = "(Tervalidasi)";
                $keputusan2 = "1";
                if (mysqli_num_rows($data4) >= 1) {
                } else {
                    $warna3 = "btn-success";
                    $text3 = "";
                    $keputusan2 = "2";
                }
            ?>
                <tr>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['jml_jam']; ?></td>
                    <td><?php echo $text1 . " " . $text2; ?></td>
                    <td><a href="?page=progress&kd=<?php echo $row['kode_kompen']; ?>&nimkl=<?php echo $row['nim']; ?>&k=<?php echo $keputusan; ?>" class="btn btn-sm <?php echo $warna2; ?>">Kalab</a>
                        <a href="?page=progress&kd=<?php echo $row['kode_kompen']; ?>&nimkpr=<?php echo $row['nim']; ?>&k=<?php echo $keputusan2; ?>" class="btn btn-sm <?php echo $warna3; ?>">Kaprodi</a>
                    </td>
                </tr>
            <?php } ?>
    </table>
    </tbody>
</body>

</html>