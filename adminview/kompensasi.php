<?php $page = "kompensasi";
include 'header.php';

require '../function.php';
if (isset($_GET["kd"])) {

    if (deleteKompen($_GET) > 0)
        echo "<script>
        Swal.fire(
            'Berhasil!',
            'Kegiatan telah dihapus!',
            'success'
        ).then((result) => {
            if (result.isConfirmed) {
                window.location='?page=kompensasi';
            }
        })
        </script>";
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
    <form id="inputan" action="" method="post">
        <select name="periode" id="periode" class="form-select form-select-sm" onchange="submitForm()">
            <?php if (isset($_POST['periode'])) {
                $periode = $_POST['periode'];
                echo '<option selected values=""> Tahun Ajaran ' . $periode . '</option>';
            } else {
                '<option selected values="">Periode</option>';
            } ?>

            <option value="2022 - 2023 Genap">Tahun Ajaran 2022 - 2023 Genap</option>
            <option value="2022 - 2023 Ganjil">Tahun Ajaran 2022 - 2023 Ganjil</option>
            <option value="2021 - 2022 Genap">Tahun Ajaran 2021 - 2022 Genap</option>
            <option value="2021 - 2022 Ganjil">Tahun Ajaran 2021 - 2022 Ganjil</option>
        </select>
    </form>

    <table id="example" class="table table-striped table-bordered border-light-subtle table-sm">
        <thead>
            <tr>
                <th>KODE KOMPENSASI</th>
                <th>SEMESTER</th>
                <th>KELAS</th>
                <th>JUMLAH MAHASISWA</th>
                <th>PENGAWAS</th>
                <th>TEMPAT</th>
                <th>KETUA LAB</th>
                <th>TANGGAL</th>
                <th>Progress</th>
                <th>AKSI</th>
            </tr>
        </thead>

        <tbody>
            <?php

            if (isset($_POST['periode'])) {
                $periode = $_POST['periode'];
                $data = mysqli_query($conn, "select kode_kompen, prodi, semester, kelas, jml_mhs, pengawas.nama, 
                tempat.nama as namatempat, tempat.kalab, tanggal, waktu from admin_kompen 
                INNER JOIN pengawas ON admin_kompen.nik_pengawas = pengawas.nik 
                INNER JOIN tempat ON admin_kompen.kode_ruang = tempat.kode_ruang where periode = '$periode'");
            } else {
                $data = mysqli_query($conn, "select kode_kompen, prodi, semester, kelas, jml_mhs, pengawas.nama, 
                tempat.nama as namatempat, tempat.kalab, tanggal, waktu from admin_kompen 
                INNER JOIN pengawas ON admin_kompen.nik_pengawas = pengawas.nik 
                INNER JOIN tempat ON admin_kompen.kode_ruang = tempat.kode_ruang where periode = '2022 - 2023 Genap'");
            }



            while ($row = mysqli_fetch_array($data)) {

                $kode_kompen = $row['kode_kompen'];

                $data2 = mysqli_query($conn, "select * from mhs_kompen where kode_kompen='$kode_kompen' and v_pengawas='-'")
            ?>
                <tr>
                    <td><?php echo $row['kode_kompen']; ?></td>
                    <td><?php echo $row['semester']; ?></td>
                    <td><?php echo $row['kelas']; ?></td>
                    <td><?php echo $row['jml_mhs']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['namatempat']; ?></td>
                    <td><?php echo $row['kalab']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><a href="?page=progress&kd=<?php echo $row['kode_kompen']; ?>"><?php if (mysqli_num_rows($data2) >= 1) {
                                                                                            echo "Belum Selesai";
                                                                                        } else {
                                                                                            echo "Selesai";
                                                                                        } ?> </a></td>
                    <td><a href="?page=kompensasi&kd=<?php echo $row['kode_kompen']; ?>" class="btn btn-sm btn-danger btn-delet">Hapus</a>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

<script>
    $('.btn-delet').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')

        Swal.fire({
            title: 'Hapus Kegiatan?',
            text: "Menghapus kegiatan ini juga akan menghapus kegiatan yang sudah dikirim ke pengawas dan mahasiswa",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batalkan',
            confirmButtonText: 'Ya Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        })
    })
</script>

</html>