<?php $page = "dashboard";
include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <section>
    <div class="row">
        <div class="col">
            <td>
                <blockquote class="quote-info mt-0 bayangan">
                    <h5 id="tip">Selamat Datang </h5>
                    <p>Admin</p>
                </blockquote>
            </td>
        </div>
        <div class="col">
            <td>
                <blockquote class="quote-orange mt-0 bayangan">
                    <h5 id="tip">Tanggal Hari Ini </h5>
                    <p><?php echo date("Y/m/d") . "<br>"; ?> </p>
                </blockquote>
            </td>
        </div>
    </div>
    <br>
    </section>

    <section>
    <a href="?page=list" class="btn btn-success">Cetak Data Kompensasi</a>
    </section>
    
    <section>
    <br>
    <table id="example" class="table table-striped border-light-subtle">
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
    </section>
</body>

</html>