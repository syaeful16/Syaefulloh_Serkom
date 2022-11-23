<?php
    require 'function.php';

    $id = $_GET['id'];
    
    $data = query("SELECT * FROM penyewa WHERE id=$id");

    if(isset($_POST['ubah'])) {
        if( updateData($_POST) > 0) {
            echo "
                <script> alert('Berhasil diupdate');
                document.location.href='viewData.php'</script>
            ";
        } else {
            echo "<script> alert('Gagal diupdate');
            document.location.href='editData.php'</script>";
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sewa</title>
    <link rel="stylesheet" href="css/stylee.css">
</head>
<body>
    <div class="main">
        <div class="form-input">
            <div class="header">
                <h1>Edit Data Penyewa</h1>
                <a href="viewData.php">Lihat Data &rightarrow;</a>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                <div class="input-value">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" id="namalengkap" value="<?= $data['nama'] ?>" required>
                </div>
                <div class="input-value">
                    <label for="notlpn">No. Telepon</label>
                    <input type="text" name="notlpn" id="notlp" value="<?= $data['no_telepon'] ?>" required>
                </div>
                <div class="input-value">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="" cols="30" rows="10" required><?= $data['alamat'] ?></textarea>
                        <!-- <input type="text" name="nama" id="namalengkap"> -->
                </div>
                <div class="input-value">
                    <label for="tglSewa">tanggal Sewa</label>
                    <input type="date" name="tglSewa" id="tglSewa" value="<?= $data['tgl_penyewaan'] ?>" required>
                </div>
                <button type="submit" class="btn-simpan" name="ubah">SIMPAN</button>
            </form>
        </div>
        <div class="img-input">
            <img src="img/motor.jpg" alt="">
            <div></div>
            <h2>Sewa Motor.</h2>
        </div>
    </div>
</body>
</html>