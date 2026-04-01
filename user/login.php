<?php

require '../functions.php';

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

    // cek username
    if (mysqli_num_rows($result) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            header("Location: user.php");
            exit;
        }

    }

    echo "<script>alert('username / password salah!');</script>";

}

?>

    <link rel="stylesheet" href="user.css">

<body class="auth">

<div class="auth-box">

    <form method="post">

        <h2>Login</h2>

        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Login</button>

        <p class="auth-text">
            Belum punya akun? 
            <a href="registrasi.php">Daftar</a>
        </p>

    </form>

</div>