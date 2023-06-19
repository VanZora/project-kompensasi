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
    <?php
    include "../function.php";

    $nim = $_GET['id'];
    $semester = $_GET['smt'];
    $data = mysqli_query($conn, "select * from mahasiswa where nim='$nim'");

    while ($row = mysqli_fetch_array($data)) {

        $nim = $row['nim'];
        $data2 = mysqli_query($conn, "select count(ket) as alfa from logabsen where ket='Alfa' and nim_mhs='$nim' and semester='$semester'");
        $alfa = mysqli_fetch_assoc($data2);

        $data3 = mysqli_query($conn, "select count(ket) as izin from logabsen where ket='Izin' and nim_mhs='$nim' and semester='$semester'");
        $izin = mysqli_fetch_assoc($data3);

        $data4 = mysqli_query($conn, "select count(ket) as sakit from logabsen where ket='Sakit' and nim_mhs='$nim' and semester='$semester'");
        $sakit = mysqli_fetch_assoc($data4); ?>

        <p><?php echo $row['nama']; ?></p>

        <table class="table table-bordered">
            <tr>
                <td>
                    <p>Alfa : <?php echo $alfa['alfa']; ?></p>
                </td>
                <td>
                    <p>Izin : <?php echo $izin['izin']; ?></p>
                </td>
                <td>
                    <p>Sakit : <?php echo $sakit['sakit']; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    $dataDet = mysqli_query($conn, "select * from logabsen where ket='Alfa' and nim_mhs='$nim' and semester='$semester'");
                    while ($row2 = mysqli_fetch_array($dataDet)) { ?>

                        <p>Pertemuan ke <?php echo $row2['pertemuan']; ?> tanggal <?php echo $row2['tanggal']; ?></p>
                    <?php } ?>
                </td>
                <td>
                    <?php
                    $dataDet = mysqli_query($conn, "select * from logabsen where ket='Izin' and nim_mhs='$nim' and semester='$semester'");
                    while ($row2 = mysqli_fetch_array($dataDet)) { ?>

                        <p>Pertemuan ke <?php echo $row2['pertemuan']; ?> tanggal <?php echo $row2['tanggal']; ?></p>
                    <?php } ?>
                </td>
                <td>
                    <?php
                    $dataDet = mysqli_query($conn, "select * from logabsen where ket='Sakit' and nim_mhs='$nim' and semester='$semester'");
                    while ($row2 = mysqli_fetch_array($dataDet)) { ?>

                        <p>Pertemuan ke <?php echo $row2['pertemuan']; ?> tanggal <?php echo $row2['tanggal']; ?></p>
                    <?php } ?>
                </td>
            </tr>

        </table>

    <?php } ?>
</body>

<script>
    document.querySelector('.click').addEventListener('click', (e) => {
    // Do whatever you want
    e.target.textContent = 'Clicked!';
    });
</script>
</html>