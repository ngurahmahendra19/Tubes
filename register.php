<?php 

session_start();

if( isset($_SESSION['username']) ){
    header("Location: dashboard.php");
}

?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
          <h1>Register</h1>
            <form method="POST" action="process/registerProcess.php">
                <label>Username</label>
                <br>
                <input name="username" type="text">
                <br>
                <label>Email</label>
                <br>
                <input name="email" type="text">
                <br>
                <label>Password</label>
                <br>
                <input name="password" type="password">
                <br>
                <label>Nama</label>
                <br>
                <input name="nama" type="text">
                <br>
                <label>Alamat</label>
                <br>
                <input name="alamat" type="text">
                <br>
                <label>Nomor Telepon</label>
                <br>
                <input name="telp" type="text">
                <br>
                <button name="btnRegister" type="submit" value="btnRegister">Register</button>
                <p> Sudah punya akun?
                  <a href="login.php">Login</a>
                </p>
            </form>
        </div>
    </body>
</html>