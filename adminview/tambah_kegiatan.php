<?php $page = "kompensasi";
include 'header.php';

require '../function.php';
if (isset($_POST["atur"])) {

    if (atur_kegiatan($_POST) > 0) {
        header("location:?page=kompensasi");
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<table id="example">

</table>
    <?php
    $semester = $_GET['smt'];
    $prodi = $_GET['prd'];
    $kelas = $_GET['kls'];
    $jumlah = $_GET['jml'];

    ?>
    <form action="" method="post">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">SEMESTER</label>
            <input name="semester" type="text" class="form-control" id="validationDefault01" value="<?php echo $semester; ?>" readonly required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">PRODI</label>
            <input name="prodi" type="text" class="form-control" id="validationDefault01" value="<?php echo $prodi; ?>" readonly required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">KELAS</label>
            <input name="kelas" type="text" class="form-control" id="validationDefault01" value="<?php echo $kelas; ?>" readonly required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">JUMLAH MAHASISWA</label>
            <input name="jml_mhs" type="text" class="form-control" id="validationDefault01" value="<?php echo $jumlah; ?>" readonly required>
        </div>
        <div class="mb-3">
            <select name="pengawas" class="form-select" aria-label="Default select example">
            <option selected>Pilih Pengawas</option>
                <?php
                $data = mysqli_query($conn, "select * from pengawas");
                foreach ($data as $row) { ?>
                    <option value="<?php echo $row['nik']; ?>"><?php echo $row['nama']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tempat</label>
            <input name="tempat" type="text" class="form-control" id="validationDefault01" placeholder="Atur Tempat" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal Mulai</label>
            <input name="tanggal" type="date" class="form-control" id="validationDefault01" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Waktu Kegiatan</label>
            <input name="waktu" type="text" class="form-control" id="validationDefault01" placeholder="Atur lama kegiatan" required>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <input type="submit" name="atur" value="Atur" class="btn btn-secondary" type="button">
            <a href="?page=jadwalpage" class="btn btn-outline-secondary"> Kembali</a>
        </div>
    </form>
</body>

</html>