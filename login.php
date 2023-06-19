<?php
session_start();

if(isset($_SESSION["login"])){
    header("location:javascript://history.go(-1)");
    exit;
}

require 'function.php';
    if(isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

        

        if(mysqli_num_rows($result) == 1){

            $row = mysqli_fetch_assoc($result);
            $_SESSION["user"] = $row['username'];

            if(password_verify($password, $row["password"])){

                    $_SESSION["login"] = true;

                    if($row["role"] == "mahasiswa"){
                        header("Location: mahasiswaview/index.php");
                    }
                    else if($row["role"] == "pengawas"){
                        header("Location: pengawasview/index.php");
                    }
                    else if($row["role"] == "admin"){
                        header("Location: adminview/index.php");
                    }

                    exit;
            }
        }
        $error = true;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Halaman Login</h1>

    <?php if(isset($error)) : ?>
        <p style="color: red;">Username / password salah</p>
    <?php endif; ?>

    <form action="" method="post">

    <ul>
        <li>
            <label for="usename">Username :</label>
            <input type="text" name="username" id="username">
        </li>
        <li>
            <label for="password">Password :</label>
            <input type="password" name="password" id="password">
        </li>
        <li>
            <button type="submit" name="login">Login</button>
        </li>
    </ul>

    </form>
</body>
</html>