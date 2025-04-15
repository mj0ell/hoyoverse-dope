<?php
include '../pages/navbar-admin.php';
include '../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/data-pelanggan.css">
    <link rel="icon" href="../assets/icon/favicon-16x16.png" type="image/x-icon"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg rounded">
                <div class="card-header" style="background-color:#ffff; color: #fff;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Data Pelanggan</h5>
                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#tambah-data">Tambah Data</button>
                        </button>
                    </div>
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
                        <table class="table table-bordered table-hover table-striped text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>ID Pelanggan</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Alamat</th>
                                    <th>Nomor Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-dark"> <!-- membuat isi tabel gelap -->
                                <?php
                                $data = mysqli_query($conn, "SELECT * FROM pelanggan");
                                $no = 1;
                                while ($d = mysqli_fetch_array($data)) {
                                    echo '
                                    <tr>
                                        <td>' . $no++ . '</td>
                                        <td>' . $d['PelangganID'] . '</td>
                                        <td>' . $d['NamaPelanggan'] . '</td>
                                        <td>' . $d['Alamat'] . '</td>
                                        <td>' . $d['NomorTelepon'] . '</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data' . $d['PelangganID'] . '">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data' . $d['PelangganID'] . '">
                                                 Hapus
                                            </button>
                                        </td>
                                    </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambah-data" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">Tambah Data Pelanggan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="../config/proses-pelanggan.php?action=simpan" method="post">
                <div class="modal-body">
                    <input type="hidden" name="PelangganID" class="form-control bg-dark text-light mb-3" placeholder="ID Pelanggan" required>
                    <input type="text" name="NamaPelanggan" class="form-control bg-dark text-light mb-3" placeholder="Nama Pelanggan" required>
                    <input type="text" name="Alamat" class="form-control bg-dark text-light mb-3" placeholder="Alamat" required>
                    <input type="text" name="NomorTelepon" class="form-control bg-dark text-light mb-3" placeholder="Nomor Telepon" required>
                </div>
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
$data = mysqli_query($conn, "SELECT * FROM pelanggan");
while ($d = mysqli_fetch_array($data)) {
?>
    <!-- Modal Edit -->
    <div class="modal fade" id="edit-data<?php echo $d['PelangganID']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title">Edit Data Pelanggan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="../config/proses-pelanggan.php?action=update" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="PelangganID" value="<?php echo $d['PelangganID']; ?>">
                        <input type="text" name="NamaPelanggan" class="form-control bg-dark text-light mb-3" value="<?php echo $d['NamaPelanggan']; ?>" required>
                        <input type="text" name="Alamat" class="form-control bg-dark text-light mb-3" value="<?php echo $d['Alamat']; ?>" required>
                        <input type="text" name="NomorTelepon" class="form-control bg-dark text-light mb-3" value="<?php echo $d['NomorTelepon']; ?>" required>
                    </div>
                    <div class="modal-footer bg-dark">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="hapus-data<?php echo $d['PelangganID']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title">Hapus Data Pelanggan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="../config/proses-pelanggan.php?action=hapus" method="post">
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus <strong><?php echo $d['NamaPelanggan']; ?></strong>?</p>
                        <input type="hidden" name="PelangganID" value="<?php echo $d['PelangganID']; ?>">
                    </div>
                    <div class="modal-footer bg-dark">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>

<?php include('footer.php'); ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
