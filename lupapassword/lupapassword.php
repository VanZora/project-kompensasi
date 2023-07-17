<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../adminlte.min.css_v=3.2.0">
    <script src="../index.js"></script>
    <script src="../sweetalert2.all.min.js"></script>

    <style>
        .registration-form {
            padding: 100px;
        }

        .registration-form form {
            background-color: #fff;
            max-width: 600px;
            margin: auto;
            padding: 50px 70px;
            border-top-left-radius: 30px;
            border-top-right-radius: 30px;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
        }
        h2 {
            color: grey;
        }
    </style>
</head>

<?php
require '../function.php';

$username = $_GET['usr'];
?>

<body style="background-color: #CFE5F1">
    <div class="registration-form">

        <form action="" method="post" enctype="multipart/form-data">
            <div style="text-align:center">
                <h2>Ganti Password</h2>
            </div><br>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Password</label>
                <input name="username" type="hidden" value="<?php echo $username; ?>">
                <input name="password" type="password" class="form-control" id="validationDefault01" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Confirm Password</label>
                <input name="password2" type="password" class="form-control" id="validationDefault01" required>
            </div><br><br>

            <div class="d-grid gap-2">
                <input type="submit" name="ganti" value="Ganti Password" class="btn btn-secondary btn-sm" type="button">
            </div><br>

            <div class="d-grid gap-2">
                <a href="konfirmasi.php" class="btn btn-outline-secondary btn-sm" type="button">Kembali</a>
            </div>
        </form>

    </div>
</body>

<?php


if (isset($_POST["ganti"])) {

    if (gantiPassword($_POST) > 0) {
        echo "<script>
        Swal.fire(
            'Berhasil!',
            'Password telah diperbarui!',
            'success'
        ).then((result) => {
            if (result.isConfirmed) {
                window.location='../login.php';
            }
        })
        </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>

</html>