<?php
require 'function.php';
if (isset($_POST["kehadiran"])) {

    if (kehadiran($_POST) > 0) {
        echo "<script>
                    alert('kehadiran baru berhasil ditambahkan');
                    </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>

<body>
    <h1>Halaman Registrasi</h1>

    <form action="" method="post">
        <ul>
            <li>
                <?php
                $data = mysqli_query($conn, "select * from mahasiswa")
                ?>
                <label for="username">NIM :</label>
                <select name="nim" id="">
                    <?php
                    while ($row = mysqli_fetch_array($data)) { ?>
                        <option value="<?php echo $row['nim'];?>"><?php echo $row['nama'];?></option>
                    <?php }
                    ?>
                </select>
            </li>
            <li>
                <label for="semester">Semester :</label>
                <select name="semester" id="">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </li>
            <li>
                <?php
                $data = mysqli_query($conn, "select * from matkul")
                ?>
                <label for="username">Nama Matkul :</label>
                <select name="matkul" id="">
                    <?php
                    while ($row = mysqli_fetch_array($data)) { ?>
                        <option value="<?php echo $row['nama'];?>"><?php echo $row['nama'];?> <?php echo $row['id_matkul'];?></option>
                    <?php }
                    ?>
                </select>
            </li>
            <li>
            <label for="semester">Tanggal :</label>
                <input type="date" name="tanggal">
            </li>
            <li>
            <label for="semester">Pertemuan :</label>
                <input type="text" name="pertemuan">
            </li>
            <li>
                <label for="semester">Keterangan :</label>
                <select name="keterangan" id="">
                    <option value="Hadir">Hadir</option>
                    <option value="Alfa">Alfa</option>
                    <option value="Sakit">Sakit</option>
                </select>
            </li>
            <li>
                <button type="submit" name="kehadiran">Register:</button>
            </li>
        </ul>
    </form>
</body>

</html>