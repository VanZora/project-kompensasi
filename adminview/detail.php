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
    <form id="inputan" action="" method="post">
        <select name="semester" id="semester" onchange="submitForm()">
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
    $semester = "Total";
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

    <p><?php echo $row['nama']; ?></p>
    <p>Total ketidakhadiran semester <?php echo $semester; ?> adalah <?php echo $total; ?></p>

    <table>
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
</body>

</html>