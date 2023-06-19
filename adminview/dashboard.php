<?php $page = "dashboard"; include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="" method="post">
        <input type="text" name="search">
        <button id="search-button" type="submit" class="btn btn-secondary">
            <i class="bx bx-search"></i>
        </button>
    </form>
    <table class="table table-striped table-bordered border-dark-subtle">
        <tr>
            <th>NIM</th>
            <th>NAMA MAHASISWA</th>
            <th>SEMESTER</th>
            <th>KELAS</th>
            <th>PRODI</th>
            <th>TOTAL TIDAK HADIR</th>
            <th>AKSI</th>
        </tr>

        <?php
        include "../function.php";
        
        if (isset($_POST['search'])) {
            $CARI = $_POST['search'];
            $data = mysqli_query($conn, "select * from mahasiswa where nama LIKE '%$CARI%'");
        } else {
            $data = mysqli_query($conn, "select * from mahasiswa");
        }



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

                    <td><a href="?page=detail&id=<?php echo $row['nim']; ?>" class="btn btn-warning btn-sm">Detail</a>
                </tr>
            </form>

        <?php } ?>
    </table>
</body>

</html>