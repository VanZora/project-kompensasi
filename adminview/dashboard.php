<?php $page = "dashboard";
include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kompensasi</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.0/css/buttons.dataTables.min.css">
</head>

<body>
    <div class="row">
        <div class="col">
            <td>
                <blockquote class="quote-info mt-0 bayangan">
                    <h5 id="tip">Selamat Datang! Kompensasi Teknik Informatika</h5>
                    <p>Admin Prodi </p>
                </blockquote>
            </td>
        </div>
        <div class="col">
            <td>
                <blockquote class="quote-orange mt-0 bayangan">
                    <h5 id="tip">Tahun Ajaran </h5>
                    <p>2022 - 2023 Genap</p>
                </blockquote>
            </td>
        </div>
    </div>

    <div class="table-responsive">
    <table id="example" class="table table-striped border-light-subtle">
        <thead>
            <tr>
                <th>NIM</th>
                <th>NAMA MAHASISWA</th>
                <th>SEMESTER</th>
                <th>KELAS</th>
                <!-- <th>PRODI</th> -->
                <th>TOTAL TIDAK HADIR</th>
                <th>AKSI</th>
                <th>TANGGUNGAN</th>
                <th>STATUS</th>
            </tr>
        </thead>

        <tbody>
            <?php
            include "../function.php";

            $data = mysqli_query($conn, "select distinct nim, nama, mahasiswa.semester, mahasiswa.kelas, prodi from mahasiswa INNER JOIN logabsen ON mahasiswa.nim = logabsen.nim_mhs where ket!='Hadir'");
            while ($row = mysqli_fetch_array($data)) { ?>
                <form action="" method="post">
                    <tr>
                        <td><?php echo $row['nim']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['semester']; ?></td>
                        <td><?php echo $row['kelas']; ?></td>
                        <!-- <td><?php echo $row['prodi']; ?></td> -->
                        <?php
                        $nim = $row['nim'];
                        $data2 = mysqli_query($conn, "select count(ket) as total from logabsen where ket!='Hadir' and nim_mhs='$nim'");
                        $row2 = mysqli_fetch_assoc($data2);
                        ?>

                        <td><?php echo $row2['total']; ?></td>

                        <td><a href="?page=detail&id=<?php echo $row['nim']; ?>">Detail</a></td>

                            <?php
                            $datax = mysqli_query($conn, "select * from mhs_kompen where nim_mhs='$nim'");
                            $isi = mysqli_fetch_assoc($datax);

                            if(mysqli_num_rows($datax) == 1){
                                $total_potong = $isi['jml_jam'];
                                $ket = ' Jam';
                            } else {
                                $total_potong = 'Belum di set';
                                $ket = '';
                            }

                            $tuntas = mysqli_query($conn, "select * from mhs_kompen where nim_mhs='$nim' and (v_pengawas='VALID' and v_aprodi='VALID')");
                            $dataz = mysqli_query($conn, "select * from mhs_kegiatan where nim_mhs='$nim'");
                            $input = 0;
                            while ($row = mysqli_fetch_array($dataz)) {
                                if(mysqli_num_rows($dataz) >= 1){
                                    $total_potong -= $row['durasi'];
                                } else{

                                }
                                
                            }
                            ?>

                        <td><?php echo $total_potong . $ket; ?></td>
                        <td><?php if (mysqli_num_rows($tuntas) == 1) {
                                echo 'Tuntas';
                            } else {
                                echo 'Belum Tuntas';
                            } ?></td>
                    </tr>
                </form>
            <?php } ?>

        </tbody>
    </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.0/js/buttons.print.min.js"></script>

</html>