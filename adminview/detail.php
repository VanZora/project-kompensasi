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
<button class="btn btn-outline-secondary btn-sm" onclick="history.back()"><i class='bx bx-arrow-back' ></i></button><br><br>
    <form id="inputan" action="" method="post">
        <select name="semester" id="semester" onchange="submitForm()" class="form-select form-select-sm">
            <option selected values="">Pilih semester</option>
            <option value="1">Semester 1</option>
            <option value="2">Semester 2</option>
            <option value="3">Semester 3</option>
            <option value="4">Semester 4</option>
        </select>
    </form>

    <?php
    include "../function.php";

    $nim = $_GET['id'];
    $semester = "1 - 4";
    $data = mysqli_query($conn, "select * from mahasiswa where nim='$nim'");

    $row = mysqli_fetch_assoc($data);

    $nim = $row['nim'];

    if (isset($_POST['semester'])) {
        $semester = $_POST['semester'];
        $data2 = mysqli_query($conn, "select count(ket) as alfa from logabsen where ket='Alfa' and nim_mhs='$nim' and semester='$semester'");
        $data3 = mysqli_query($conn, "select count(ket) as izin from logabsen where ket='Izin' and nim_mhs='$nim' and semester='$semester'");
        $data4 = mysqli_query($conn, "select count(ket) as sakit from logabsen where ket='Sakit' and nim_mhs='$nim' and semester='$semester'");
    } else {
        $data2 = mysqli_query($conn, "select count(ket) as alfa from logabsen where ket='Alfa' and nim_mhs='$nim'");
        $data3 = mysqli_query($conn, "select count(ket) as izin from logabsen where ket='Izin' and nim_mhs='$nim'");
        $data4 = mysqli_query($conn, "select count(ket) as sakit from logabsen where ket='Sakit' and nim_mhs='$nim'");
    }

    $izin = mysqli_fetch_assoc($data3);
    $alfa = mysqli_fetch_assoc($data2);
    $sakit = mysqli_fetch_assoc($data4);

    $total = $izin['izin'] + $alfa['alfa'] + $sakit['sakit'];
    ?>

    <h4><?php echo $row['nama'] . " " . $row['nim'] ?></h4>
    <p>Total ketidakhadiran semester <?php echo $semester; ?> adalah <?php echo $total; ?></p>

    <div class="row">
        <div class="col">
            <div class="card text-white bg-danger mb-3" style="max-width: 25rem;">
                <div class="card-header">Alfa</div>
                <div class="card-body">
                    <h5 class="card-title">Total Alfa :</h5>
                    <h3 class="card-text"><?php echo $alfa['alfa']; ?></h3>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-warning mb-3" style="max-width: 25rem;">
                <div class="card-header">Izin</div>
                <div class="card-body">
                    <h5 class="card-title">Total Izin :</h5>
                    <h3 class="card-text"><?php echo $izin['izin']; ?></h3>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-success mb-3" style="max-width: 25rem;">
                <div class="card-header">Sakit</div>
                <div class="card-body">
                    <h5 class="card-title">Total Sakit :</h5>
                    <h3 class="card-text"><?php echo $sakit['sakit']; ?></h3>
                </div>
            </div>
        </div>
    </div>
    <?php $data = mysqli_query($conn, "select pertemuan, tanggal, nm_matkul, matkul.nm_dosen, ket from logabsen INNER JOIN matkul ON logabsen.nm_matkul = matkul.nama where ket!='Hadir' and nim_mhs='$nim' and semester='$semester'"); ?>

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

</html>