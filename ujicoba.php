<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "db_kompen");


    ?>

    <table>
        <?php

        $hari = 56 / 24;
        $sisahari = 56 % 24;
        

        for ($i = 0; $i < $hari; $i++) {
            echo "asasas";
        }
        echo $hari;
        ?>

    </table>
</body>

</html>