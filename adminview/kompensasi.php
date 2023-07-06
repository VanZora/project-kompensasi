<?php $page = "kompensasi";
include 'header.php';

require '../function.php';
if (isset($_GET["kd"])) {

    if (deleteKompen($_GET) > 0)
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
            $data = mysqli_query($conn, "select kode_kompen, prodi, semester, kelas, jml_mhs, pengawas.nama, tempat, tanggal, waktu from admin_kompen INNER JOIN pengawas ON admin_kompen.nik_pengawas = pengawas.nik");

            while ($row = mysqli_fetch_array($data)) {

                $kode_kompen = $row['kode_kompen'];

                $data2 = mysqli_query($conn, "select * from mhs_kompen where kode_kompen='$kode_kompen' and v_pengawas='-'")
            ?>
                <tr>
                    <td><?php echo $row['kode_kompen']; ?></td>
                    <td><?php echo $row['semester']; ?></td>
                    <td><?php echo $row['prodi']; ?></td>
                    <td><?php echo $row['kelas']; ?></td>
                    <td><?php echo $row['jml_mhs']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['tempat']; ?></td>
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