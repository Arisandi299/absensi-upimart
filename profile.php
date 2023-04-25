<?php
session_start();
require_once "./layout/header.php";
require_once "./layout/nav.php";
require_once "./helper/conn.php";
require_once "./helper/Home_user.php";

$conn = conn();
$user = Home_user($conn, $_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>absensi upimart | profile</title>
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>

  <?php
  headers();
  nav($user['nama'], $user['pic']);
  ?>

  <main class="profile-page">
    <h1 class="main-title">Profile </h1>
    <div class="profile-wrapper">
      <img src="./user_pic//<?= $user['pic']; ?>" alt="" class="profile-pic">
      <div class="profile-detail">
        <p class="name">Name : <?= $user['nama']; ?></p>
        <p class="No_hp">No HP : <?= $user['hp']; ?></p>
        <p class="alamat">alamat: <?= $user['alamat']; ?></p>
        <p class="shiff">Shif : <?= $user['shif']; ?></p>
      </div>
    </div>
    </form>
  </main>
  <script type="module">
    import {
      navbar
    } from "./js/navbar.js";
    navbar();
  </script>
</body>

</html>