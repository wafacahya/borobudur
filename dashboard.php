<?php
session_start();
include 'db.php';
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'user'){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Candi Borobudur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- ====== HEADER / NAVBAR ====== -->
<header>
    <div class="logo">
        <h2>InJourney Destinations</h2>
    </div>
    <nav>
        <ul>
            <li><a href="#beranda" class="active">Beranda</a></li>
            <li><a href="#tentang">Sejarah</a></li>
            <li><a href="#galeri">Galeri</a></li>
            <li><a href="#agenda">Agenda</a></li>
            <li><a href="#kontak">Kontak</a></li>
            <li><a href="#" onclick="confirmLogout()">Logout</a></li>
            <script>
            function confirmLogout() {
                if (confirm('Apakah kamu yakin ingin logout?')) {
                window.location.href = 'logout.php';
                }
            }
</script>

        </ul>
    </nav>
</header>

<!-- ====== HERO SECTION ====== -->
<section id="beranda" class="hero">
    <div class="overlay"></div>
    <div class="content">
        <h1>Selamat Datang, <?= htmlspecialchars($_SESSION['nama']); ?>!</h1>
        <p>Temukan pesona dan keajaiban Candi Borobudur di setiap langkah perjalananmu.</p>
        <button onclick="window.location.href='tiket.php'">🎟️ Beli Tiket Sekarang</button>
    </div>
</section>

<!-- ====== SEJARAH ====== -->
<section id="tentang" class="tentang" style="padding: 80px 10%; background: #fff; text-align: center;">
    <div class="container">
        <h2 style="font-size: 2rem; margin-bottom: 20px;">Sejarah Candi Borobudur</h2>
        <p style="max-width: 800px; margin: 0 auto 20px; line-height: 1.8;">
            Candi Borobudur dibangun pada abad ke-8 oleh Dinasti Syailendra dan menjadi monumen Buddha terbesar di dunia.
            Setiap relief yang terpahat di dindingnya mengandung kisah kehidupan dan ajaran spiritual yang mendalam.
        </p>
        <p style="max-width: 800px; margin: 0 auto; line-height: 1.8;">
            Kini, Borobudur menjadi destinasi wisata dan pusat spiritual yang dikagumi dunia. 
            Dari puncaknya, kamu dapat menyaksikan panorama menakjubkan perbukitan Menoreh dan Gunung Merapi.
        </p>
    </div>
</section>

<!-- ====== GALERI ====== -->
<section id="galeri" class="galeri">
    <div class="container">
        <h2>Galeri Candi Borobudur</h2>
        <div class="grid">
            <?php
            $galeri = $conn->query("SELECT * FROM galeri ORDER BY id DESC LIMIT 6");
            if ($galeri && $galeri->num_rows > 0) {
                while ($row = $galeri->fetch_assoc()) {
                    echo '<div class="card">
                            <img src="img/'.htmlspecialchars($row['gambar']).'" alt="'.htmlspecialchars($row['judul']).'">
                            <p>'.htmlspecialchars($row['judul']).'</p>
                        </div>';
                }
            } else {
                echo '<p>Tidak ada foto galeri untuk saat ini.</p>';
            }
            ?>
        </div>
    </div>
</section>

<!-- ====== AGENDA / EVENT ====== -->
<section id="agenda" class="agenda">
    <div class="container">
        <h2>Agenda & Info Wisata</h2>
        <div class="agenda-box">
            <div class="agenda-item">
                <h3>Festival Borobudur</h3>
                <p>Festival tahunan menampilkan seni budaya, pertunjukan musik, dan pameran UMKM lokal.</p>
            </div>
            <div class="agenda-item">
                <h3>Sunrise Experience</h3>
                <p>Rasakan pengalaman melihat matahari terbit dari puncak Candi Borobudur yang mempesona.</p>
            </div>
            <div class="agenda-item">
                <h3>Wisata Edukasi</h3>
                <p>Belajar sejarah dan filosofi Candi bersama pemandu profesional di area taman wisata.</p>
            </div>
        </div>
    </div>
</section>

<!-- ====== FOOTER ====== -->
<footer id="kontak" style="background: #222; color: #fff; text-align: center; padding: 30px 0;">
    <div class="container">
        <p>© <?= date('Y'); ?> Candi Borobudur | Dikembangkan untuk Proyek Wisata Budaya</p>
    </div>
</footer>

</body>
</html>
