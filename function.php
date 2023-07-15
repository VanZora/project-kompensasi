<?php
$conn = mysqli_connect("localhost", "root", "", "db_kompen");
function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $role = strtolower(stripslashes($data["role"]));

    $result = mysqli_query($conn, "select username from users where username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar')
            </script>";
        return false;
    }

    if ($password != $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!')
                </script>";
        return false;
    }

    if ($data['role'] == "admin") {
        $password = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "insert into users values('', '$username', '$password', '-', '$role')");
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "insert into users values('', '$username', '$password', '$password2', '$role')");
    }

    return mysqli_affected_rows($conn);
}

function kehadiran($data)
{
    global $conn;

    $nim = $data['nim'];
    $semester = $data['semester'];
    $nm_matkul = $data['matkul'];
    $tanggal = $data['tanggal'];
    $pertemuan = $data['pertemuan'];
    $keterangan = $data['keterangan'];

    mysqli_query($conn, "insert into logabsen values('', '$nim', '$semester', '$nm_matkul', '$tanggal', '$pertemuan', '$keterangan')");

    return mysqli_affected_rows($conn);
}

function atur_kegiatan($data)
{
    global $conn;

    $semester = $data['semester'];
    $prodi = $data['prodi'];
    $kelas = $data['kelas'];
    $jml_mhs = $data['jml_mhs'];
    $pengawas = $data['pengawas'];
    $tempat = $data['tempat'];
    $tanggal = $data['tanggal'];
    $waktu = $data['waktu'];

    $kode = date("mYdhis");
    mysqli_query($conn, "insert into admin_kompen values('$kode', '$semester', '$prodi','$kelas', '$jml_mhs', '$pengawas','$tempat','$tanggal','$waktu')");
    mysqli_query($conn, "insert into tgs_pengawas values('', '$kode', '$pengawas', '$semester', '$prodi', '$kelas', '$jml_mhs','$tempat','$tanggal','$tempat', 'OTW')");

    $data = mysqli_query($conn, "select distinct mahasiswa.kelas, mahasiswa.prodi, mahasiswa.semester, 
            mahasiswa.nim from logabsen INNER JOIN mahasiswa ON logabsen.nim_mhs = mahasiswa.nim WHERE ket!='Hadir' 
            and logabsen.semester=mahasiswa.semester and mahasiswa.kelas='$kelas' and mahasiswa.prodi='$prodi' and mahasiswa.semester='$semester'");

    while ($row = mysqli_fetch_array($data)) {
        $nim = $row['nim'];

        $data2 = mysqli_query($conn, "select matkul.jam, logabsen.nim_mhs, logabsen.ket from 
        logabsen INNER JOIN matkul ON logabsen.nm_matkul = matkul.nama INNER JOIN mahasiswa 
        ON logabsen.nim_mhs = mahasiswa.nim where nim_mhs='$nim' and ket!='Hadir' and 
        logabsen.semester = mahasiswa.semester");

        $jamtotal = 0;
        while ($hitung = mysqli_fetch_array($data2)) {
            $jamtotal += $hitung['jam'];
        }

        $jamtotal = $jamtotal * 2;
        mysqli_query($conn, "insert into mhs_kompen values('', '$kode', '$nim', '$jamtotal', '$pengawas', '-', '-')");

        mysqli_query($conn, "insert into mhs_kegiatan values('', '$nim', '$kode', '', 0, 'belum')");
        // $hari = $jamtotal / 24;
        // for ($i = 0; $i < $hari; $i++) {
        //     mysqli_query($conn, "insert into mhs_kegiatan values('', '$nim', '$kode', '-', 'belum')");
        // }
    }

    return mysqli_affected_rows($conn);
}

function deleteKompen($data)
{
    global $conn;

    $kode_kompen = $data['kd'];
    mysqli_query($conn, "delete from admin_kompen where kode_kompen='$kode_kompen'");

    return mysqli_affected_rows($conn);
}

function ubahKegiatan($data)
{
    global $conn;

    $nim = $data['usr'];
    $kode_kompen = $data['kd'];
    $total_potong = $data['wkt'];

    $datasql = mysqli_query($conn, "select * from mhs_kegiatan where nim_mhs='$nim' and kode_kompen='$kode_kompen'");

    $input = 0;
    while ($row = mysqli_fetch_array($datasql)) {
        $id = $row['id'];
        $kegiatan = $data['kegiatan' . strval($input)];
        $durasi = $data['durasi' . strval($input)];
        $tuntas = "belum";
        if (empty($data['tuntas' . strval($input)])) {
            // mysqli_query($conn, "delete from mhs_kegiatan order by id desc limit 1");
        } else {
            $tuntas = "ya";
        }
        mysqli_query($conn, "update mhs_kegiatan set kegiatan='$kegiatan', durasi='$durasi', tuntas='$tuntas' where id='$id'");
        $input++;
    }
    if (empty($data['tuntas' . strval($input - 2)]) && mysqli_num_rows($datasql) > 1) {
        mysqli_query($conn, "delete from mhs_kegiatan order by id desc limit 1");
    } 
    if (empty($data['tuntas' . strval($input - 1)])) {
        
    }
    else{
        if ($total_potong > 0) {
            mysqli_query($conn, "insert into mhs_kegiatan values('', '$nim', '$kode_kompen', '', 0, 'belum')");
        }
    }

    return mysqli_affected_rows($conn);
}

function validasiPengawas($data)
{
    global $conn;

    $nim = $data['nim'];
    $kode_kompen = $data['kd'];

    mysqli_query($conn, "update mhs_kompen set v_pengawas='VALID' where nim_mhs='$nim' and kode_kompen='$kode_kompen'");

    return mysqli_affected_rows($conn);
}

function cancelPengawas($data)
{
    global $conn;

    $nim = $data['nim'];
    $kode_kompen = $data['kd'];

    mysqli_query($conn, "update mhs_kompen set v_pengawas='-' where nim_mhs='$nim' and kode_kompen='$kode_kompen'");

    return mysqli_affected_rows($conn);
}

function validasiKaprodiAll($data)
{
    global $conn;

    $kode_kompen = $data['kd'];

    mysqli_query($conn, "update mhs_kompen set v_aprodi='VALID' where kode_kompen='$kode_kompen'");

    return mysqli_affected_rows($conn);
}
function cancelKaprodiAll($data)
{
    global $conn;

    $kode_kompen = $data['kd'];

    mysqli_query($conn, "update mhs_kompen set v_aprodi='-' where kode_kompen='$kode_kompen'");

    return mysqli_affected_rows($conn);
}

function validasiKalabAll($data)
{
    global $conn;

    $kode_kompen = $data['kd'];

    mysqli_query($conn, "update mhs_kompen set v_pengawas='VALID' where kode_kompen='$kode_kompen'");

    return mysqli_affected_rows($conn);
}
function cancelKalabAll($data)
{
    global $conn;

    $kode_kompen = $data['kd'];

    mysqli_query($conn, "update mhs_kompen set v_pengawas='-' where kode_kompen='$kode_kompen'");

    return mysqli_affected_rows($conn);
}

function validasiKalab($data)
{
    global $conn;

    $nim = $data['nimkl'];
    $kode_kompen = $data['kd'];
    $keputusan = "";

    if($data['k'] == "1"){
        $keputusan = "-";
    }else{
        $keputusan = "VALID";
    }

    mysqli_query($conn, "update mhs_kompen set v_pengawas='$keputusan' where nim_mhs='$nim' and kode_kompen='$kode_kompen'");

    return mysqli_affected_rows($conn);
}

function validasiKaprodi($data)
{
    global $conn;

    $nim = $data['nimkpr'];
    $kode_kompen = $data['kd'];
    $keputusan = "";

    if($data['k'] == "1"){
        $keputusan = "-";
    }else{
        $keputusan = "VALID";
    }

    mysqli_query($conn, "update mhs_kompen set v_aprodi='$keputusan' where nim_mhs='$nim' and kode_kompen='$kode_kompen'");

    return mysqli_affected_rows($conn);
}