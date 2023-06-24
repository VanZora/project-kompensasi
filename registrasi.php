<?php
require 'function.php';
if (isset($_POST["register"])) {

    if (registrasi($_POST) > 0) {
        echo "<script>
                    alert('user baru berhasil ditambahkan');
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
                <label for="username">Username :</label>
                <select name="username" id="">
                    <?php
                    while ($row = mysqli_fetch_array($data)) { ?>
                        <option value="<?php echo $row['nim'];?>"><?php echo $row['nama'];?></option>
                    <?php }
                    ?>
                </select>

                <!-- <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username">
            </li> -->
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="password">Konfirmasi Password :</label>
                <input type="password" name="password2" id="password2">
            </li>
            <li>
                <label for="role">Role :</label>
                <select name="role" id="">
                    <option value="admin">Admin</option>
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="pengawas">Pengawas</option>
                </select>
            </li>
            <li>
                <button type="submit" name="register">Register:</button>
            </li>
        </ul>
    </form>
</body>

</html>