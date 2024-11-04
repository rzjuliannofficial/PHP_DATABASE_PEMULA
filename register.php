<?php
  include "service/database.php";
  session_start();

  $register_message="";

   //jika user telah login , user tidak bisa masuk dalam page login ataupun register lagi 
   if (isset($_SESSION["is_login"])) {
    header("location : dasboard.php");
  }

  if(isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hash_password = hash('sha256' , $password);
    //$hash_password = hash("sha256", $password ); //untuk meng enkripsi password users agar data tidak bocor

    try {
      $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hash_password')";//$hash_password
  
      if ($db->query($sql)) { //contoh penggunaan query untuk mengeksekusi perintah SQL yang disimpan dalam variabel $sql dalam databaase
        $register_message="Register berhasil, silahkan login";
      }else {
        $register_message="Register gagal, silahkan coba lagi";
      }
    } catch (mysqli_sql_exception $e) {
      $register_message= "username telah digunakan";
    }
    //untuk menginsert data username dan password
    // $sql untuk menampung datanya
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
    <link rel="stylesheet" href="">
</head>

<body>
    <?php include "layout/header.html"?>
    
    <h3>Daftar Akun</h3>

    <i><?= $register_message ?></i>

    <form action="register.php" method="POST">
    <input type="text" placeholder="username" name="username" required />
    <input type="password" placeholder="password" name="password" required>    
    <button type="submit" name="register">Register</button>
    </form>


    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <?php include  "layout/footer.html"?>
</body>

</html>