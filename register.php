<?php
include 'db.php';

if(isset($_POST['register'])){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (nama,email,password,role) VALUES ('$nama','$email','$password','user')";
    if($conn->query($sql)){
        header("Location: login.php");
    } else {
        echo "Gagal mendaftar: ".$conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun</title>
    <style>
        body {font-family: Poppins; display:flex; justify-content:center; align-items:center; height:100vh; background:#f9f9f9;}
        form {background:white; padding:30px; border-radius:10px; box-shadow:0 0 10px #ccc; width:300px;}
        input, button {width:100%; margin:8px 0; padding:10px;}
        button {background:#27ae60; color:#fff; border:none; cursor:pointer;}
    </style>
</head>
<body>
<form method="post">
    <h2>Register</h2>
    <input type="text" name="nama" placeholder="Nama Lengkap" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="register">Daftar</button>
    <p>Sudah punya akun? <a href="login.php">Login</a></p>
</form>
</body>
</html>
