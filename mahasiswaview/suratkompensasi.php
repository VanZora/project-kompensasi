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
    </style>

</head>

<body>
    <?php
    include "../function.php";
    session_start();
    $user = $_SESSION["user"];
    $data = mysqli_query($conn, "select mahasiswa.nama, mahasiswa.nim, pengawas.nama as namapengawas from mhs_kompen INNER JOIN mahasiswa ON mhs_kompen.nim_mhs = mahasiswa.nim INNER JOIN pengawas ON mhs_kompen.nik_pengawas = pengawas.nik where mhs_kompen.nim_mhs='$user'");
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

        <p>Saya yang bertanda tangan di bawah ini :</p>

        <table>
            <tr>
                <td style="width: 30%;">Nama</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;"><?php echo $row['nama']; ?></td>
            </tr>
            <tr>
                <td style="width: 30%;">NIM</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;"><?php echo $row['nim']; ?></td>
            </tr>
            <tr>
                <td style="width: 30%; vertical-align: top;">Pengawas</td>
                <td style="width: 5%; vertical-align: top;">:</td>
                <td style="width: 65%;"><?php echo $row['namapengawas']; ?></td>
            </tr>
            <tr>
                <td style="width: 30%;">Kegiatan</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;"><?php
                                        while ($rowz = mysqli_fetch_array($data2)) { ?>
                        <?php echo $rowz['kegiatan']; ?>
                    <?php } ?></td>

            </tr>
        </table>

        <p>Telah menyelesaikan kompensasi presensi sesuai prosedur dan pedoman akademik Politeknik Negeri Banjarmasin</p>

        <div style="width: 50%; text-align: left; float: right;">Banjarmasin, 20 Januari 2020</div><br>
        <div style="width: 50%; text-align: left; float: right;">Yang bertanda tangan,</div><br><br><br><br><br>
        <div style="width: 50%; text-align: left; float: right;">Nurhidayati</div>

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