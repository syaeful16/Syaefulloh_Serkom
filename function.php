<?php 
$host = "localhost";
$username = "root";
$password = "";
$db = "rentalmotor";

$conn = mysqli_connect($host, $username, $password, $db);

function query($query) {
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    while($row = mysqli_fetch_assoc($result)) {
        $rows = $row;
    }

    return $rows;
}

function addDataSewa($data) {
    global $conn;

    $nama = $data['nama'];
    $notlpn = $data['notlpn'];
    $alamat = $data['alamat'];
    $tglSewa = $data['tglSewa'];
    $jmlHari = $data['jmlHari'];
    $totalBayar = $data['totalHarga'];

    // upload gambar
    $gambar = upload();
    if( !$gambar ) {
        return false;
    }

    // var_dump($gambar); die;
    // var_dump($nama, $notlpn, $alamat, $gambar, $tglSewa, $jmlHari, $totalBayar); die;

    $query = "INSERT INTO penyewa (id, nama, no_telepon, alamat, ktp, tgl_penyewaan, jumlah_hari, total_bayar) VALUES ('', '$nama', '$notlpn', '$alamat', '$gambar', '$tglSewa', '$jmlHari', '$totalBayar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {
    $namaFile = $_FILES['ktp']['name'];
    $ukuranFile = $_FILES['ktp']['size'];
    $error = $_FILES['ktp']['error'];
    $tmpName = $_FILES['ktp']['tmp_name'];

    if($error === 4) {
        echo "<script> alert('Pilih gambar terlebih dahulu') </script>";
        return false;
    }

    $eksGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if( !in_array($ekstensiGambar, $eksGambarValid)) {
        echo "<script> alert('Yang Anda upload bukan gambar') </script>";
        return false;
    }

    if( $ukuranFile > 5242880) {
        echo "<script> alert('Ukuran Gambar melebihi 5 MB') </script>";
        return false;
    }

    //Buat nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;


    move_uploaded_file($tmpName, 'img/upload/' . $namaFileBaru);

    return $namaFileBaru;
}

function viewAllData() {
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM penyewa");

    return $result;
}

function totalPendapatan() {
    global $conn;
    $result = mysqli_query($conn, "SELECT SUM(total_bayar) as total FROM penyewa");

    return $result;
}

function totalPenyewa() {
    global $conn;
    $result = mysqli_query($conn, "SELECT COUNT(nama) as total FROM penyewa");

    return $result;
}

function showForLineChart() {
    global $conn;
    $result = mysqli_query($conn, "SELECT COUNT(nama) as total, tgl_penyewaan FROM penyewa GROUP BY tgl_penyewaan");

    return $result;
}

function deleteData($id) {
    global $conn;
    
    mysqli_query($conn, "DELETE FROM penyewa WHERE id=$id");

    return mysqli_affected_rows($conn);
}

function updateData($data) {
    global $conn;

    $id= $data['id'];
    $nama = $data['nama'];
    $notlpn = $data['notlpn'];
    $alamat = $data['alamat'];
    $tglSewa = $data['tglSewa'];


    $query = "UPDATE penyewa SET nama='$nama', no_telepon='$notlpn', alamat='$alamat', tgl_penyewaan='$tglSewa' WHERE id=$id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

?>