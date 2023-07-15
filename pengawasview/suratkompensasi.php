<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #judul {
            text-align: center;
        }

        #halaman {
            width: auto;
            height: auto;
            position: absolute;
            border: 1px solid;
            padding-top: 30px;
            padding-left: 30px;
            padding-right: 30px;
            padding-bottom: 80px;
        }

        .border {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
            padding: 15px;
        }
    </style>

</head>

<body>
    <?php
    include "../function.php";
    session_start();
    $user = $_SESSION["user"];
    $nik = $_GET['nik'];

    $data = mysqli_query($conn, "select * from pengawas where nik='$nik'");

    $data2 = mysqli_query($conn, "select * from mhs_kegiatan where nim_mhs='$user'");
    $row = mysqli_fetch_assoc($data);

    ?>
    <div id=halaman>
        <table>
            <tr>
                <td width="10%"><img src="../img/PolibanLogo.png" alt="" width="100%"></td>
                <td width="55%" style="text-align: center;">
                    <h5>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI <br>
                        POLITEKNIK NEGERI BANJARMASIN <br>
                        JURUSAN TEKNIK ELEKTRO <br>
                        PROGRAM STUDI TEKNIK INFORMATIKA</h5>
                </td>
            </tr>
        </table>
        <h4 id=judul>KETERANGAN SELESAI KOMPENSASI</h4>

        <p>Saya yang bertanda tangan di bawah ini ....</p>
        <p>Kepada : </p>

        <table>
            <tr>
                <td style="width: 30%;">Nama</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;"><?php echo $row['nama']; ?></td>
            </tr>
            <tr>
                <td style="width: 30%;">NIK</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;"><?php echo $row['nik']; ?></td>
            </tr>
        </table>

        <br><br>

        <p>Telah ditugaskan untuk mengawasi kompensasi presensi sesuai prosedur dan pedoman akademik Politeknik Negeri Banjarmasin.</p>

        <?php
        $validasiP = mysqli_query($conn, "select * from mhs_kompen where nim_mhs='$user' and v_pengawas='VALID'");
        $validasiA = mysqli_query($conn, "select * from mhs_kompen where nim_mhs='$user' and v_aprodi='VALID'");
        $namattd = mysqli_query($conn, "select tempat.kalab as namatempat from mhs_kompen INNER JOIN admin_kompen ON mhs_kompen.kode_kompen = admin_kompen.kode_kompen INNER JOIN tempat ON admin_kompen.kode_ruang = tempat.kode_ruang where nim_mhs='$user'");
        $nama = mysqli_fetch_assoc($namattd);
        ?>

        <table>
            <tr>
                <td></td>
                <td width=""></td>
                <td>Banjarmasin, 20 Januari 2020</td>
            </tr>
            <tr>
                <td></td>
                <td width="55%"></td>
                <td>Tanda tangan Wadir</td>
            </tr>
            <tr>
                <td><img src="../img/Mantah.png" alt=""></td>
                <td></td>
                <td><img src="../img/qrlagi.png" alt=""></td>
            </tr>
            <tr>
            <td><?php if (mysqli_num_rows($validasiP) >= 1) {
                        echo $nama['namatempat'];
                    } else {
                    } ?></td>
                <td></td>
                <td><?php if (mysqli_num_rows($validasiA) >= 1) {
                        echo 'Rahimi';
                    } else {
                    } ?></td>
            </tr>
        </table>
        <!-- <div style="width: 50%; text-align: left; float: right;">Banjarmasin, 20 Januari 2020</div><br>
        <div style="width: 50%; text-align: left; float: right;">Yang bertanda tangan, <br> <img src="../img/qrsaja.png" alt=""></div>
        
        <br><div style="width: 50%; text-align: left; float: right;">Nurhidayati</div> -->

    </div>
</body>
<script type="text/javascript">
    var css = '@page { size: portrait; }',
        head = document.head || document.getElementsByTagName('head')[0],
        style = document.createElement('style');

    style.type = 'text/css';
    style.media = 'print';

    if (style.styleSheet) {
        style.styleSheet.cssText = css;
    } else {
        style.appendChild(document.createTextNode(css));
    }

    head.appendChild(style);
    window.print();
</script>

</html>