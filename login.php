<?php
include 'db.php';
session_start();

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        if(password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] == 'admin'){
                header("Location: dashboard_admin.php");
            } else {
                header("Location: dashboard.php");
            }
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {font-family: Poppins; display:flex; justify-content:center; align-items:center; height:100vh; background:#eef2f3;}
        form {background:white; padding:30px; border-radius:10px; box-shadow:0 0 10px #ccc; width:300px;}
        input, button {width:100%; margin:8px 0; padding:10px;}
        button {background:#2980b9; color:#fff; border:none; cursor:pointer;}
        .error {color:red; font-size:0.9em;}
    </style>
</head>
<body>
<form method="post">
    <h2>Login</h2>
    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Masuk</button>
    <p>Belum punya akun? <a href="register.php">Daftar</a></p>
</form>
</body>
</html>
