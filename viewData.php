<?php 
    require 'function.php';

    $result = viewAllData();
    $totalPendapatan = mysqli_fetch_assoc(totalPendapatan());
    $totalPenyewa = mysqli_fetch_assoc(totalPenyewa());
    $viewForChart = showForLineChart();

    foreach ($viewForChart as $dataChart) {
        $count[] = $dataChart['total'];
        $tglSewa[] = $dataChart['tgl_penyewaan'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data</title>
    <link rel="stylesheet" href="css/viewData.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="main">
        <div class="visual">
            <h1>Data Keseluruhan</h1>
            <div class="cardData">
                <div class="cardDataTotal">
                    <h3>Total Penyewa</h3>
                    <h1><?php echo $totalPenyewa['total'] ?></h1>
                </div>
                <div class="cardDataTotal">
                    <h3>Total Pendapatan</h3>
                    <h1>Rp <?php echo number_format($totalPendapatan['total'],0,' ','.') ?></h1>
                </div>
            </div>
            <div style="background-color:white; padding: 1rem; border-radius: 6px;">
                <canvas id="myChart"></canvas>
            </div>
            <div class="btnBack">
                <a href="index.php">&leftarrow; Kembali</a>
            </div>
        </div>
        <div class="viewTable">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>No. Telepon</th>
                        <th>Alamat</th>
                        <th>KTP</th>
                        <th>Tgl Sewa</th>
                        <th>Jumlah Hari</th>
                        <th>Total Bayar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($result as $data) :?>
                    <tr>
                        <td><?php echo $data["nama"]?></td>
                        <td><?php echo $data["no_telepon"]?></td>
                        <td><?php echo $data["alamat"]?></td>
                        <td><img src="img/upload/<?php echo $data["ktp"]?>" alt="" width="50" height="50"></td>
                        <td><?php echo $data["tgl_penyewaan"]?></td>
                        <td align="center"><?php echo $data["jumlah_hari"]?></td>
                        <td><?php echo "Rp ".number_format($data["total_bayar"],0,' ','.');?></td>
                        <td><a href="editData.php?id=<?php echo $data["id"]?>"><img src="img/ic_edit.png" alt=""></a><a href="delete.php?id=<?php echo $data["id"] ?>"><img src="img/ic_del.png" alt=""></a></td>
                        <!-- <img src="img/ic_edit.png" alt=""></a> -->
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- edit data  -->
    <div class="pop-edit" id="pop">
        <div class="editCard">
            <div class="header">
                <h1>Edit Data</h1>
                <img src="img/ic_close.png" alt="" onclick="hidePop()">
            </div>
            <form action="" method="post">
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
                    <textarea name="alamat" id="alamat" cols="30" rows="10" required></textarea>
                        <!-- <input type="text" name="nama" id="namalengkap"> -->
                </div>
                <div class="input-value">
                    <label for="tglSewa">tanggal Sewa</label>
                    <input type="date" name="tglSewa" id="tglSewa" required>
                </div>
                <button type="submit" class="btn-simpan" name="ubah">SIMPAN</button>
            </form>
        </div>
    </div>
</body>
<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($tglSewa)?>,
        datasets: [{
        label: 'Total Penyewa',
        data: <?php echo json_encode($count)?>,
        borderWidth: 0,
        backgroundColor: 'rgb(46, 116, 221)'
        }]
    },
    options: {
        scales: {
        y: {
            beginAtZero: true
        }
        }
    }
    });

</script>
</html>