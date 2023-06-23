<?php $page = "dashboard"; 
include 'header.php'; 
// if(array_key_exists('cetak', $_POST)) {
//     cetak();
// } untuk memanggil fungsi lewat button
?>
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
    <a href="suratkompensasi.php" target="_blank" id="somebutton">Cetak</a>
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
    session_start();
    $user = $_SESSION["user"];
    $data = mysqli_query($conn, "select * from mahasiswa where nim='$user'");
    
    $row = mysqli_fetch_array($data);
    $nim = $row['nim'];

    if(isset($_POST['semester'])){
        $semester = $_POST['semester'];

        $data2 = mysqli_query($conn, "select count(ket) as alfa from logabsen where ket='Alfa' and nim_mhs='$nim' and semester='$semester'");
        $data3 = mysqli_query($conn, "select count(ket) as izin from logabsen where ket='Izin' and nim_mhs='$nim' and semester='$semester'");
        $data4 = mysqli_query($conn, "select count(ket) as sakit from logabsen where ket='Sakit' and nim_mhs='$nim' and semester='$semester'");
    }
    else {
        $semester = $row['semester'];

        $data2 = mysqli_query($conn, "select count(ket) as alfa from logabsen where ket='Alfa' and nim_mhs='$nim' and semester='$semester'");
        $data3 = mysqli_query($conn, "select count(ket) as izin from logabsen where ket='Izin' and nim_mhs='$nim' and semester='$semester'");
        $data4 = mysqli_query($conn, "select count(ket) as sakit from logabsen where ket='Sakit' and nim_mhs='$nim' and semester='$semester'");
    
    }
    ?>
    
    <a href="?page=detail&id=<?php echo $row['nim'];?>&smt=<?php echo $semester; ?>" class="btn btn-warning btn-sm">Detail</a>
    <?php
        
        $izin = mysqli_fetch_assoc($data3);
        $alfa = mysqli_fetch_assoc($data2);
        $sakit = mysqli_fetch_assoc($data4); ?>

        <p><?php echo $row['nama']; ?></p>

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
        </table>
</body>
</html>