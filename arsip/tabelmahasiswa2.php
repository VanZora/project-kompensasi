<?php $page = "dashboard";
include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kompensasi</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
    <div class="row">
        <div class="col">
            <td>
                <blockquote class="quote-info mt-0 bayangan">
                    <h5 id="tip">Selamat Datang! </h5>
                    <p>Admin Prodi </p>
                </blockquote>
            </td>
        </div>
        <div class="col">
            <td>
                <blockquote class="quote-orange mt-0 bayangan">
                    <h5 id="tip">Tahun Ajaran </h5>
                    <p>2022 - 2023 </p>
                </blockquote>
            </td>
        </div>
    </div>

    <table id="mauexport" class="table table-striped border-light-subtle">
        <thead>
            <tr>
                <th>NIM</th>
                <th>NAMA MAHASISWA</th>
                <th>SEMESTER</th>
                <th>KELAS</th>
                <th>PRODI</th>
                <th>TOTAL TIDAK HADIR</th>
                <th>AKSI</th>
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
                        <td><?php echo $row['prodi']; ?></td>

                        <?php
                        $nim = $row['nim'];
                        $data2 = mysqli_query($conn, "select count(ket) as total from logabsen where ket!='Hadir' and nim_mhs='$nim'");
                        $row2 = mysqli_fetch_assoc($data2);
                        ?>

                        <td><?php echo $row2['total']; ?></td>

                        <td><a href="?page=detail&id=<?php echo $row['nim']; ?>">Detail</a>
                    </tr>
                </form>
            <?php } ?>

        </tbody>
    </table>
    <script>
    $(document).ready(function() {
        $('#mauexport').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ]
        } );
    } );

    </script>
</body>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

</html>