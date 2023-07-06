<?php $page = "dashboard";
include 'header.php'; ?>
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
<button class="btn btn-outline-secondary btn-sm" onclick="history.back()"><i class='bx bx-arrow-back' ></i></button><br><br>
    <?php
    include "../function.php";

    $nim = $_GET['id'];
    $semester = $_GET['smt'];
    $data = mysqli_query($conn, "select pertemuan, tanggal, nm_matkul, matkul.nm_dosen, ket from logabsen INNER JOIN matkul ON logabsen.nm_matkul = matkul.nama where ket!='Hadir' and nim_mhs='$nim' and semester='$semester'"); ?>

    <table class="table">
        <tr>
            <td>No</td>
            <td>Pertemuan</td>
            <td>Tanggal</td>
            <td>Matkul</td>
            <td>Dosen</td>
            <td>Keterangan</td>
        </tr>

        <?php 
        $nomor = 1;
        while ($row = mysqli_fetch_array($data)){ 
            ?>
        
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $row['pertemuan']; ?></td>
                <td><?php echo $row['tanggal']; ?></td>
                <td><?php echo $row['nm_matkul']; ?></td>
                <td><?php echo $row['nm_dosen']; ?></td>
                <td><?php echo $row['ket']; ?></td>
            </tr>
            
        <?php $nomor++; }
        
        ?>
    </table>
</body>

<script>
    document.querySelector('.click').addEventListener('click', (e) => {
        // Do whatever you want
        e.target.textContent = 'Clicked!';
    });
</script>

</html>