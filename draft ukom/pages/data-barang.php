<?php
session_start();
include '../pages/navbar-admin.php';
include '../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/data-barang.css">
    <link rel="icon" href="../assets/icon/favicon-16x16.png" type="image/x-icon">
</head>
<body>

<div class="container mt-4">
    <div class="card shadow rounded bg-dark text-light">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i claAss="bi bi-box-seam-fill me-2"></i>Manajemen Produk</h5>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah-data">Tambah Data</button>
        </div>
        <div class="card-body">
            <?php
            if (isset($_GET['pesan'])) {
                $alertType = "success";
                $message = "";
                if ($_GET['pesan'] == "simpan") {
                    $message = "Data berhasil disimpan.";
                } elseif ($_GET['pesan'] == "update") {
                    $message = "Data berhasil diperbarui.";
                } elseif ($_GET['pesan'] == "hapus") {
                    $message = "Data berhasil dihapus.";
                }
                if ($message) {
                    echo "<div class='alert alert-$alertType' role='alert'>$message</div>";
                }
            }
            ?>
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barcode</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM produk");
                        $no = 1;
                        $modals = []; // Simpan modal di array
                        while ($d = mysqli_fetch_array($data)) {
                            echo '
                            <tr>
                                <td>' . $no++ . '</td>
                                <td>' . $d['ProdukID'] . '</td>
                                <td>' . $d['NamaProduk'] . '</td>
                                <td>Rp. ' . number_format($d['Harga'], 0, ',', '.') . '</td>
                                <td>' . $d['Stok'] . '</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data' . $d['ProdukID'] . '">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data' . $d['ProdukID'] . '">Hapus</button>
                                </td>
                            </tr>';

                            // Modal Edit
                            $modals[] = '
                            <div class="modal fade" id="edit-data' . $d['ProdukID'] . '" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-dark text-light">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="../config/proses-barang.php?action=update" method="post">
                                            <div class="modal-body">
                                                <input type="text" name="ProdukID" class="form-control mb-2" value="' . $d['ProdukID'] . '" readonly>
                                                <input type="text" name="NamaProduk" class="form-control mb-2" value="' . $d['NamaProduk'] . '">
                                                <input type="number" name="Harga" class="form-control mb-2" value="' . $d['Harga'] . '">
                                                <input type="number" name="Stok" class="form-control" value="' . $d['Stok'] . '">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>';

                            // Modal Hapus
                            $modals[] = '
                            <div class="modal fade" id="hapus-data' . $d['ProdukID'] . '" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-dark text-light">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form method="post" action="../config/proses-barang.php?action=hapus">
                                            <div class="modal-body">
                                                <input type="hidden" name="ProdukID" value="' . $d['ProdukID'] . '">
                                                Yakin hapus <b>' . $d['NamaProduk'] . '</b>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambah-data" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="../config/proses-barang.php?action=simpan" method="post">
                <div class="modal-body">
                    <input type="text" name="ProdukID" class="form-control mb-2" placeholder="ID Produk" required>
                    <input type="text" name="NamaProduk" class="form-control mb-2" placeholder="Nama Produk" required>
                    <input type="number" name="Harga" class="form-control mb-2" placeholder="Harga" required>
                    <input type="number" name="Stok" class="form-control" placeholder="Stok" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<!-- Render all modals -->
<?php
if (!empty($modals)) {
    foreach ($modals as $modal) {
        echo $modal;
    }
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>