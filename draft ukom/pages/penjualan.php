<?php
include '../config/koneksi.php';
include '../config/proses-transaksi.php';
include '../pages/navbar-admin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/data-barang.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../assets/icon/favicon-16x16.png" type="image/x-icon"> 
</head>
<body>
    <div class="container mt-4">
        <div class="card shadow rounded bg-dark text-light">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-cart-check-fill me-2"></i>Penjualan</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <?php
                    if (isset($_GET['pesan'])) {
                        if ($_GET['pesan'] == "sukses") {
                            echo '<div class="alert alert-success">Data Berhasil Disimpan</div>';
                        } elseif ($_GET['pesan'] == "hapus") {
                            echo '<div class="alert alert-success">Data Berhasil Dihapus</div>';
                        } elseif ($_GET['pesan'] == "gagal") {
                            echo '<div class="alert alert-danger">Barang Tidak Ditemukan</div>';
                        }
                    }
                    ?>
                    <label for="barcode" class="form-label">Scan Barcode</label>
                    <input class="form-control" id="barcode" name="barcode" type="text" placeholder="Masukkan Barcode">
                    <button type="submit" class="btn btn-primary mt-2">Tambah ke Keranjang</button>
                </form>

                <div class="table-responsive mt-4">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            if (isset($_SESSION['keranjang'])) {
                                foreach ($_SESSION['keranjang'] as $key => $item) {
                                    $subtotal = $item['Harga'] * $item['Jumlah'];
                                    $total += $subtotal;
                                    echo "<tr>
                                        <td>{$item['NamaProduk']}</td>
                                        <td>Rp " . number_format($item['Harga'], 0, ',', '.') . "</td>
                                        <td>{$item['Jumlah']}</td>
                                        <td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>
                                    </tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                    <label for="total" class="form-label">Total Pembelian</label>
                    <input class="form-control" id="total" type="text" value="Rp <?php echo number_format($total, 0, ',', '.'); ?>" readonly>

                    <label for="bayar" class="form-label mt-3">Jumlah Uang</label>
                    <input class="form-control" id="bayar" type="number" placeholder="Masukkan jumlah uang" oninput="hitungKembalian()" required>

                    <label for="kembalian" class="form-label mt-3">Kembalian</label>
                    <input class="form-control" id="kembalian" type="text" readonly>

                    <form action="../config/proses-transaksi.php" method="POST" class="mt-4 d-flex gap-2">
                        <button type="submit" name="simpan" class="btn btn-success">Bayar</button>
                        <button type="submit" name="hapus" class="btn btn-danger">Hapus Semua</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function hitungKembalian() {
            let total = <?php echo $total; ?>;
            let bayar = document.getElementById('bayar').value;
            let kembalian = bayar - total;

            if (kembalian >= 0) {
                document.getElementById('kembalian').value = 'Rp ' + kembalian.toLocaleString('id-ID');
            } else {
                document.getElementById('kembalian').value = 'Uang kurang!';
            }
        }
    </script>
</body>
</html>
