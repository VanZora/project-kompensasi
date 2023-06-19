<?php $page = "kompensasi"; include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table class="table table-striped table-bordered border-dark-subtle">
        <tr>
            <td>SEMESTER</td>
            <td>KELAS</td>
            <td>JUMLAH MAHASISWA</td>
            <td>AKSI</td>
        </tr>

        <?php
        include '../function.php';
        $data = mysqli_query($conn, "select distinct mahasiswa.kelas, mahasiswa.semester from logabsen INNER JOIN mahasiswa ON logabsen.nim_mhs = mahasiswa.nim WHERE ket!='Hadir' and logabsen.semester = mahasiswa.semester");
        
        while ($row = mysqli_fetch_array($data)) {
            $mkelas = $row['kelas'];
            $msemester = $row['semester']; 

            $data2 = mysqli_query($conn, "select count(distinct mahasiswa.kelas, mahasiswa.semester, mahasiswa.nama) 
            as jumlah from logabsen INNER JOIN mahasiswa ON logabsen.nim_mhs = mahasiswa.nim WHERE ket!='Hadir' 
            and logabsen.semester=mahasiswa.semester and mahasiswa.kelas='$mkelas' and mahasiswa.semester='$msemester'");
            
            $jumlah = mysqli_fetch_assoc($data2);
            ?>
            <tr>
                <td><?php echo $row['semester'];?></td>
                <td><?php echo $row['kelas'];?></td>
                <td><?php echo $jumlah['jumlah'];?></td>
                <td><a href="?page=tambah_kegiatan&smt=<?php echo $row['semester'];?>&kls=<?php echo $row['kelas'];?>&jml=<?php echo $jumlah['jumlah'];?>">Set Kegiatan</a></td>
            </tr>
        <?php } ?>


    </table>
</body>

</html>