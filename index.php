<?php
// if (!isset($_SESSION['login']) || $_SESSION['login'] == false) {
//     header("Location: login.php");
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>absensi upimart | dashboard</title>
</head>
<link rel="stylesheet" href="./css/style.css">
</head>

<body class="main-home-wrapper">
    <img src="./img/hero2.png" alt="hero" class="hero">
    <main class="main-home">
        <div class="title-wrapper">
            <span class="title">
                Aplikasi Absensi
            </span>
            <span class="subtitle">
                Upimart
            </span>
            <div class="button-wrapper">
                <button class="btn-belanja"><a href="login.php">Login</a></button>
                <button class="btn-belanja"><a href="who.php">Who Made this ? </a></button>

            </div>
        </div>
        <div class="home-img">
            <img src="./img/girl-doing-shopping-with-cart.png" alt="">
        </div>

    </main>
</body>

</html>