<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['id'])) {
    // header("Location: login.php");
    // exit;
}

if (isset($_POST['beli'])) {
    $tanggal = $_POST['tanggal'];
    $tipe = $_POST['tipe'];
    $dewasa = $_POST['dewasa'];
    $anak = $_POST['anak'];

    // Tentukan harga berdasarkan tipe pengunjung
    if ($tipe == 'mancanegara') {
        $hargaDewasa = 250000;
        $hargaAnak = 125000;
    } else {
        $hargaDewasa = 50000;
        $hargaAnak = 25000;
    }

    $total = ($dewasa * $hargaDewasa) + ($anak * $hargaAnak);

    // Simpan ke database
    $id_user = $_SESSION['id'] ?? 'Guest';
    $query = "INSERT INTO transaksi (id_user, tanggal, tipe, dewasa, anak, total, status)
              VALUES ('$id_user', '$tanggal', '$tipe', '$dewasa', '$anak', '$total', 'pending')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Tiket berhasil dipesan! Total: IDR " . number_format($total, 0, ',', '.') . "');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Beli Tiket Candi Borobudur</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .navbar {
      background-color: white;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .ticket-card {
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 15px;
      background: white;
      margin-bottom: 15px;
    }
    .btn-green {
      background-color: #28a745;
      color: white;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg px-4">
  <a class="navbar-brand fw-bold" href="#">InJourney Destinations</a>
  <div class="ms-auto">
    <a href="index.php" class="btn btn-link">Beranda</a>
    <a href="tiket.php" class="btn btn-link">Beli Tiket</a>
    <?php if(isset($_SESSION['nama'])): ?>
      <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    <?php else: ?>
      <a href="login.php" class="btn btn-success btn-sm">Login</a>
    <?php endif; ?>
  </div>
</nav>

<!-- Konten -->
<div class="container mt-4">
  <h3 class="mb-3">Pesan Tiket Candi Borobudur</h3>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Pilih Tanggal:</label>
      <input type="date" name="tanggal" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Pilih Tipe Pengunjung:</label>
      <select name="tipe" id="tipe" class="form-select" onchange="updateHarga()" required>
        <option value="domestik">Domestik</option>
        <option value="mancanegara">Mancanegara</option>
      </select>
    </div>

    <h5 class="mt-4">Tiket Tersedia:</h5>

    <div class="ticket-card">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h6>Borobudur Dewasa</h6>
          <p class="text-muted mb-0">06.30 - 16.30 WIB | <span id="hargaDewasa">IDR 50.000</span></p>
        </div>
        <input type="number" name="dewasa" id="dewasa" class="form-control w-25" value="0" min="0" onchange="hitungTotal()">
      </div>
    </div>

    <div class="ticket-card">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h6>Borobudur Anak</h6>
          <p class="text-muted mb-0">06.30 - 16.30 WIB | <span id="hargaAnak">IDR 25.000</span></p>
        </div>
        <input type="number" name="anak" id="anak" class="form-control w-25" value="0" min="0" onchange="hitungTotal()">
      </div>
    </div>

    <div class="text-end mt-3">
      <h5>Subtotal: <span id="total">IDR 0</span></h5>
      <button type="submit" name="beli" class="btn btn-green">Beli Tiket</button>
    </div>
  </form>
</div>

<script>
function updateHarga() {
  let tipe = document.getElementById("tipe").value;
  let hargaDewasa = tipe === "mancanegara" ? 250000 : 50000;
  let hargaAnak = tipe === "mancanegara" ? 125000 : 25000;

  document.getElementById("hargaDewasa").innerText = "IDR " + hargaDewasa.toLocaleString();
  document.getElementById("hargaAnak").innerText = "IDR " + hargaAnak.toLocaleString();
  hitungTotal();
}

function hitungTotal() {
  let tipe = document.getElementById("tipe").value;
  let hargaDewasa = tipe === "mancanegara" ? 250000 : 50000;
  let hargaAnak = tipe === "mancanegara" ? 125000 : 25000;

  let dewasa = parseInt(document.getElementById("dewasa").value) || 0;
  let anak = parseInt(document.getElementById("anak").value) || 0;

  let total = (dewasa * hargaDewasa) + (anak * hargaAnak);
  document.getElementById("total").innerText = "IDR " + total.toLocaleString();
}
</script>

</body>
</html>
