<?php 
session_start(); //syarat pakai session

if (isset($_POST['logout'])) {
    session_unset(); //unset untuk clear semua data
    session_destroy(); //destroy untuk menghancurkan datanya
    header('location: index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard</title>
    
</head>
<body>
    <?php include "layout/header.html"?>
    <h1>SELAMAT DATANG <?= $_SESSION["username"]?> di DASBOARD</h1>

    <form action="dasboard.php" method="POST">
        <button type="submit" name="logout">logout</button>
    </form>
    
    <?php include "layout/footer.html"?>
</body>
</html>