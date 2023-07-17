<?php
session_start();

if (isset($_SESSION["login"])) {
  header("location:javascript://history.go(-1)");
  exit;
}

require 'function.php';
if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

  if (mysqli_num_rows($result) == 1) {

    $row = mysqli_fetch_assoc($result);
    $_SESSION["user"] = $row['username'];

    if (password_verify($password, $row["password"])) {

      $_SESSION["login"] = true;

      if ($row["role"] == "mahasiswa") {
        header("Location: mahasiswaview/index.php");
      } else if ($row["role"] == "pengawas") {
        header("Location: pengawasview/index.php");
      } else if ($row["role"] == "admin") {
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

  <link rel="apple-touch-icon" type="image/png" href="https://cpwebassets.codepen.io/assets/favicon/apple-touch-icon-5ae1a0698dcc2402e9712f7d01ed509a57814f994c660df9f7a952f3060705ee.png" />
  <meta name="apple-mobile-web-app-title" content="CodePen">
  <link rel="shortcut icon" type="image/x-icon" href="https://cpwebassets.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico" />
  <link rel="mask-icon" type="image/x-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg" color="#111" />

  <title>Login Kompensasi</title>
  <link rel="canonical" href="https://codepen.io/YinkaEnoch/pen/PxqrZV" />


  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

  <style>
    body {
      background-color: #CFE5F1;
    }

    .main-content {
      width: 50%;
      border-radius: 20px;
      box-shadow: 0 5px 5px rgba(0, 0, 0, .4);
      margin: 5em auto;
      display: flex;
    }

    .company__info {
      background-color: #008080;
      border-top-left-radius: 20px;
      border-bottom-left-radius: 20px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      color: #fff;
    }

    .fa-android {
      font-size: 3em;
    }

    @media screen and (max-width: 640px) {
      .main-content {
        width: 90%;
      }

      .company__info {
        display: none;
      }

      .login_form {
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
      }
    }

    @media screen and (min-width: 642px) and (max-width:800px) {
      .main-content {
        width: 70%;
      }
    }

    .row>h2 {
      color: #008080;
    }

    .login_form {
      background-color: #fff;
      border-top-right-radius: 20px;
      border-bottom-right-radius: 20px;
      border-top: 1px solid #ccc;
      border-right: 1px solid #ccc;
    }

    form {
      padding: 0 2em;
    }

    .form__input {
      width: 100%;
      border: 0px solid transparent;
      border-radius: 0;
      border-bottom: 1px solid #aaa;
      padding: 1em .5em .5em;
      padding-left: 2em;
      outline: none;
      margin: 1.5em auto;
      transition: all .5s ease;
    }

    .form__input:focus {
      border-bottom-color: #008080;
      box-shadow: 0 0 5px rgba(0, 80, 80, .4);
      border-radius: 4px;
    }

    .btn {
      transition: all .5s ease;
      width: 70%;
      border-radius: 30px;
      color: #008080;
      font-weight: 600;
      background-color: #fff;
      border: 1px solid #008080;
      margin-top: 1.5em;
      margin-bottom: 1em;
    }

    .btn:hover,
    .btn:focus {
      background-color: #008080;
      color: #fff;
    }
  </style>



</head>

<body translate="no">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Yinka Enoch Adedokun">
    <title>Login Page</title>
  </head>

  <body>
    <br><br><br>
    <!-- Main Content -->
    <div class="container-fluid">
      <div class="row main-content bg-success text-center">
        <div class="col-md-4 text-center company__info">
          <span class="company__logo">
            <h2><img src="img/PolibanLogo.png" width="80%" alt=""></h2>
          </span>
          <h4 class="company_title">POLITEKNIK NEGERI BANJARMASIN</h4>
        </div>
        <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
          <div class="container-fluid">
            <div class="row">
              <h2>Log In</h2>
            </div>
            <div class="row">
              <form control="" class="form-group" method="post">
                <div class="row">
                  <input type="text" name="username" id="username" class="form__input" placeholder="Username">
                </div>
                <div class="row">
                  <!-- <span class="fa fa-lock"></span> -->
                  <input type="password" name="password" id="password" class="form__input" placeholder="Password">
                </div>
                <div class="row">
                  <p style="text-align: right;"><a href="lupapassword/konfirmasi.php">Lupa password?</a></p>
                </div>
                <?php if (isset($error)) : ?>
                  <p style="color: red;">Username / password salah</p>
                <?php endif; ?>
                <br><br><br>
                <div class="row">
                  <input type="submit" value="Masuk" class="btn" name="login">
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>

  </body>




</body>

</html>