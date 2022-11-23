<?php
    require 'function.php';

    if(isset($_POST['save'])) {
        if( addDataSewa($_POST) > 0) {
            echo "Berhasil ditambahkan";
        } else {
            echo "Gagal ditambahkan";
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
                <h1>Input Data Penyewa</h1>
                <a href="viewData.php">Lihat Data &rightarrow;</a>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="column">
                    <div class="col-1">
                        <div class="input-value">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" id="namalengkap" required>
                        </div>
                        <div class="input-value">
                            <label for="notlpn">No. Telepon</label>
                            <input type="text" name="notlpn" id="notlp" required>
                        </div>
                        <div class="input-value">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="" cols="30" rows="10" required></textarea>
                        <!-- <input type="text" name="nama" id="namalengkap"> -->
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-value">
                            <label for="ktp">KTP</label>
                            <input type="file" name="ktp" id="ktp" hidden>
                            <div class="filename">
                                <div>
                                    <span id="custom-namefile">Gambar belum dipilih</span>
                                </div>
                                <div>
                                    <button type="button" id="custom-chooseimg">Pilih Gambar</button>
                                </div>
                            </div>
                        </div>
                        <div class="input-value">
                            <label for="tglSewa">tanggal Sewa</label>
                            <input type="date" name="tglSewa" id="tglSewa" required>
                        </div>
                        <div class="input-value">
                            <label for="jmlHari">Jumlah hari</label>
                            <input type="number" name="jmlHari" id="jmlHari" onchange="totalBiaya(this.value)" required>
                        </div>
                        <h3>Total Pembayaran</h3>
                        <input type="text" name="totalHarga" id='totalharga' value='' hidden>
                        <h2>Rp. <span id="totalTxt">0</span></h2>
                    </div>
                </div>
                <button type="submit" class="btn-simpan" name="save">SIMPAN</button>
            </form>
        </div>
        <div class="img-input">
            <img src="img/motor.jpg" alt="">
            <div></div>
            <h2>Sewa Motor.</h2>
        </div>
    </div>
</body>
<script type="text/javascript">
    const inputFile = document.getElementById('ktp');
    const customText = document.getElementById('custom-namefile');
    const customBtn = document.getElementById('custom-chooseimg');

    customBtn.addEventListener('click', function() {
        inputFile.click();
    });

    inputFile.addEventListener("change", function() {
        if(inputFile.value) {
            customText.innerHTML = inputFile.files[0].name;
        } else {
            customText.innerHTML = 'Gambar belum dipilih';
        }
    });

    function totalBiaya(jmlHari) {
        var txtTotal = document.getElementById('totalTxt');
        var inTotal = document.getElementById('totalharga');

        let total = 50000 * jmlHari;
        txtTotal.innerHTML = total;
        inTotal.value = total;
    }

    // function totalHarga(jmlhari) {
    //     var totalText = document.getElementById('totalTxt');

    //     totalText.innerText = "200";
    // }

</script>
</html>