<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/data-pelanggan.css">
    <link rel="icon" href="../assets/icon/favicon-16x16.png" type="image/x-icon"> 
</head>
<body>
<?php
include '../pages/navbar-admin.php';
include '../config/koneksi.php';
?>

<div class="container mt-4">
<div class="card shadow rounded bg-dark text-light">
        <div class="card-header bg-secondary text-white d-flex justify-content-between">
            <h5 class="mb-0">Detail Penjualan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Penjualan ID</th>
                            <th>Tanggal Penjualan</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = "SELECT * FROM detailpenjualan ORDER BY DetailID DESC";
                        $data = mysqli_query($conn, $query);
                        while ($d = mysqli_fetch_assoc($data)) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $d['PenjualanID']; ?></td>
                                <td><?php echo $d['TanggalPenjualan']; ?></td>
                                <td><?php echo $d['NamaProduk']; ?></td>
                                <td><?php echo $d['Jumlah']; ?></td>
                                <td>Rp. <?php echo number_format($d['TotalHarga'], 0, ',', '.'); ?></td>
                                <td>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<script>
    function bukaCetakStruk(id) {
        window.open(`struk-selesai.php?PenjualanID=${id}`, 'Struk', 'width=400,height=600');

        setTimeout(() => {
            window.location.href = 'data-penjualan.php';
        }, 2000);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
