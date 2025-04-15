<?php 
session_start();
include('navbar-admin.php');

$namaPetugas = isset($_SESSION['nama_petugas']) ? $_SESSION['nama_petugas'] : 'Acheron';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/dashboard-admin.css">
    <link rel="icon" href="assets/icon/favicon.ico" type="image/x-icon">
  </head>

<body class="d-flex flex-column min-vh-100">
  <div class="overlay"></div>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
      <h2 class="dashboard-welcome">Welcome, <?php echo htmlspecialchars($namaPetugas); ?>!</h2>
<p class="dashboard-subtext">This is Admin dashboard, you can customize it with Visual Studio Code.</p>
      </div>
    </div>

    <div class="container my-5">
      <div class="row g-4 justify-content-center">
        <!-- Data Barang Card -->
        <div class="col-md-12">
          <div class="card custom-card text-light bg-dark shadow-lg border-0">
            <div class="card-body">
              <h5 class="card-title fw-bold">Data Barang</h5>
              <p class="card-text">Click "Tambah Barang" to add product data.</p>
            </div>
            <div class="card-footer border-0 bg-transparent">
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahDataModal">Tambah Barang</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal Add Data Barang -->
  <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-dark text-light">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Barang</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="../config/proses-barang.php?action=simpan" method="POST">
          <div class="modal-body">
            <input type="text" name="ProdukID" class="form-control mb-2" placeholder="ID Produk" required>
            <input type="text" name="NamaProduk" class="form-control mb-2" placeholder="Nama Produk" required>
            <input type="number" name="Harga" class="form-control mb-2" placeholder="Harga" required>
            <input type="number" name="Stok" class="form-control mb-2" placeholder="Stok" required>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
