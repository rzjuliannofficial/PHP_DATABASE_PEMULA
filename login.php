<?php
  include "service/database.php";
  session_start(); //syarat pakai session

  $login_message="";

  //jika user telah login , user tidak bisa masuk dalam page login ataupun register lagi 
  if (isset($_SESSION["login"]) == true) {
    header("location: dasboard.php");
    
  }

  if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $hash_password = hash("sha256", $password);//untuk meng enkripsi password users agar data tidak bocor
   

  //menggunakan query SELECT untuk mengkomper data dari database/register
  $sql = "SELECT * FROM users WHERE 
  username='$username' AND password='$hash_password' ";//$hash_password

  //kita bikin tampungan variable baru   untuk menampung hasil query
  $result = $db->query($sql);
  
  if ($result->num_rows > 0) { //jika datanya ada / lebih dari 0
    //sebelum mengarahkan ke dasboard.php kita akan membuat sesion
    //untuk mempunyai data dibalik layar
    $data = $result ->fetch_assoc();
    $_SESSION["username"] = $data["username"];
    $_SESSION["login"] = true; //menentukan user login apa belum
    //jadi data sesion ini digunakan agar kita memakai data tersebut didalam file kita nantinya.

    header("location: dasboard.php");

  }else {
    $login_message="akun tidak ditemukan";
  }
  $db->close();
}

// untuk menyimpan username dan password
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website With Login & Registration | Julian</title>
    <link rel="stylesheet" href="/coba/drive-download-20240905T103628Z-001/style.css">
</head>

<body>
    <?php include "layout/header.html"?>
    <video src="assets/Video/Purple Night Moon Clouds ｜ Custom Wallpaper.mp4" autoplay loop muted></video>
    <audio src="dj.mp3" autoplay loop></audio>


    <div class="wrapper">
        <form action="login.php"method="POST">
          <h2>Login</h2>
          <i><?= $login_message?></i>
            <div class="input-field">
            <input type="text" placeholder="username" name="username" required>
            <label>Enter username</label>
          </div>
          <div class="input-field">
            <input type="password" placeholder="password" name="password" required>
            <label>Enter your password</label>
          </div>
          <div class="forget">
            <label for="remember">
              <input type="checkbox" id="remember">
              <p>Remember me</p>
            </label>
            <a href="#">Forgot password?</a>
          </div>
          <!-- gunanya name="login". ketika tombol login di klik baru sistem baru bekerja-->
          <button type="submit" name="login">Log In</button> 
          
          <div class="register">
            <p>Don't have an account? <a href="register.php">Register</a></p>
          </div>
        </form>
      </div>


    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <?php include  "layout/footer.html"?>
</body>

</html>