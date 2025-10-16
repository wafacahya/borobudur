<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candi Borobudur</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* ======== RESET & FONT ======== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f9f9f9;
            color: #333;
        }

        /* ======== HEADER / NAVBAR ======== */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(6px);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 80px;
            z-index: 1000;
        }

        header .logo h2 {
            font-size: 1.5em;
            letter-spacing: 1px;
            color: #ffd700;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 30px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: 500;
            transition: 0.3s;
        }

        nav ul li a:hover, nav ul li a.active {
            color: #ffd700;
        }

        /* ======== HERO SECTION ======== */
        .hero {
            position: relative;
            height: 100vh;
            background: url('borobudur.jpeg') no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .hero .overlay {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.45);
        }

        .hero .content {
            position: relative;
            color: white;
            max-width: 700px;
            z-index: 2;
        }

        .hero h1 {
            font-size: 2.8em;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .hero button {
            padding: 12px 28px;
            font-size: 1em;
            border: none;
            background: #ffd700;
            color: #333;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .hero button:hover {
            background: #f4c300;
        }

        /* ======== SECTION TENTANG ======== */
        section.tentang {
            padding: 100px 80px;
            background: white;
            text-align: center;
        }

        section.tentang h2 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #444;
        }

        section.tentang p {
            font-size: 1.05em;
            line-height: 1.8;
            color: #555;
            max-width: 800px;
            margin: 0 auto;
        }

        section.tentang button {
            margin-top: 30px;
            padding: 12px 25px;
            background: #007b5e;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            cursor: pointer;
            transition: 0.3s;
        }

        section.tentang button:hover {
            background: #005a40;
        }

        /* ======== AGENDA SECTION ======== */
        section.agenda {
            padding: 100px 80px;
            background: #f2f2f2;
        }

        .agenda h2 {
            text-align: center;
            font-size: 2em;
            margin-bottom: 40px;
            color: #333;
        }

        .agenda-box {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .agenda-item {
            background: white;
            border-radius: 10px;
            padding: 25px;
            width: 300px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .agenda-item:hover {
            transform: translateY(-5px);
        }

        .agenda-item h3 {
            color: #007b5e;
            margin-bottom: 10px;
        }

        /* ======== FOOTER ======== */
        footer {
            background: #222;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 0.9em;
        }

        /* RESPONSIVE */
        @media(max-width: 768px) {
            header {
                flex-direction: column;
                padding: 10px 20px;
            }

            nav ul {
                flex-wrap: wrap;
                gap: 15px;
                justify-content: center;
            }

            section.tentang, section.agenda {
                padding: 70px 30px;
            }

            .hero h1 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <h2>InJourney Destinations</h2>
    </div>
    <nav>
        <ul>
            <li><a href="#" class="active">Beranda</a></li>
            <li><a href="#tentang">Sejarah</a></li>
            <li><a href="#agenda">Agenda</a></li>
            <li><a href="#kontak">Kontak</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>
</header>

<section class="hero">
    <div class="overlay"></div>
    <div class="content">
        <h1>Keajaiban Dunia di Tengah Pulau Jawa</h1>
        <button onclick="window.location.href='#tentang'">Jelajahi Sekarang</button>
    </div>
</section>

<section id="tentang" class="tentang">
    <h2>Sejarah Candi Borobudur</h2>
    <p>
        Candi Borobudur adalah warisan budaya dunia yang dibangun pada abad ke-8 oleh Dinasti Syailendra. 
        Candi ini merupakan monumen Buddha terbesar di dunia dan menjadi ikon kebanggaan Indonesia. 
        Relief-relief yang terpahat indah di dindingnya menggambarkan ajaran Buddha serta kisah kehidupan umat manusia.
    </p>

    <div>
        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'user'): ?>
            <button onclick="window.location.href='login.php'">🎟️ Beli Tiket Sekarang</button>
        <?php elseif(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <p>Anda login sebagai <b>Admin</b>. Kelola data di <a href="admin/dashboard.php">Dashboard</a>.</p>
        <?php else: ?>
            <button onclick="window.location.href='login.php'">🔐 Login untuk Membeli Tiket</button>
        <?php endif; ?>
    </div>
</section>

<section id="agenda" class="agenda">
    <h2>Agenda & Info Wisata</h2>
    <div class="agenda-box">
        <div class="agenda-item">
            <h3>Festival Borobudur</h3>
            <p>Menampilkan seni budaya, pameran UMKM, dan pertunjukan malam di pelataran Candi.</p>
        </div>
        <div class="agenda-item">
            <h3>Sunrise Experience</h3>
            <p>Nikmati keindahan matahari terbit dari puncak Candi Borobudur, pengalaman yang tak terlupakan.</p>
        </div>
        <div class="agenda-item">
            <h3>Tur Edukasi</h3>
            <p>Program wisata edukatif untuk pelajar dan keluarga mengenal sejarah serta filosofi Candi.</p>
        </div>
    </div>
</section>

<footer id="kontak">
    <p>© <?= date('Y'); ?> Candi Borobudur | Dikembangkan untuk Proyek Wisata Budaya</p>
</footer>

</body>
</html>
