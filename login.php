<?php
session_start();
require_once "./layout/header.php";
require_once "./layout/nav.php";
require_once "./helper/conn.php";
require_once "./helper/handleLogin.php";


if (!isset($_SESSION['login'])) {
  $_SESSION['login'] = false;
}

if ($_SESSION['login'] == true && $_SESSION['user'] != "admin") {
  header("Location: home.php");
  exit;
}

if (isset($_SESSION['user'])) {
  if ($_SESSION['user'] == 'admin') {
    header("Location: dashboard.php");
  }
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>absensi upimart</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/alertify.min.css">
  <link rel="stylesheet" href="./css/themes/bootstrap.min.css">
  <script src="./script/alertify.min.js"></script>
</head>

<body>
  <?php
  headers();
  nav();
  ?>


  <main class="login-page">
    <h1 class="main-title">Login Terlebih dahulu </h1>
    <form action="" method="post">
      <label for='username'>Username</label>
      <input type='text' name='username' id='username' />

      <label for='Password'>Password</label>
      <input type='password' name='Password' id='Password' />

      <input type="submit" value="Login">
    </form>
  </main>
  <script type="module">
    import {
      navbar
    } from "./js/navbar.js";
    navbar();
    const username = document.querySelector("[name='username']")
    const password = document.querySelector("[name='Password']");
    const submit = document.querySelector("[type='submit']");


    function sub() {
      if (username.value == false | password.value == false) {
        alertify.alert("ada yang kosong nii", "coba cek sekali lagi deh")
        return;

      }
      document.forms[0].submit();
    }

    document.forms[0].onsubmit = e => {
      e.preventDefault();
      sub();

    }
  </script>

</body>

</html>
<?php
if (isset($_POST['username']))
  try {
    $conn = conn();
    handlelogin($conn, $_POST['username'], $_POST['Password']);
  } catch (Error $e) {
    echo $e->getMessage();
  } finally {
    $conn->close();
  }
?>