<?php
session_start();
require_once "./layout/header.php";
require_once "./layout/nav.php";
require_once "./helper/conn.php";
require_once "./helper/handleForm.php";
require_once "./helper/Home_user.php";

$message = "";
if (!isset($_SESSION['login']) || $_SESSION['login'] == false || $_SESSION['user'] != 'admin') {
    header("Location: login.php");
    exit;
}

$conn = conn();
$user = Home_user($conn, $_SESSION['user']);
// $conn->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/alertify.min.css">
    <link rel="stylesheet" href="./css/themes/bootstrap.min.css">
    <script src="./script/alertify.min.js"></script>
</head>

<body>
    <?php
    headers();
    nav($user['nama'], $user['pic']);
    ?>
    <main class="tambah-page">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="left-side">
                <label for='Nama'>Nama Karyawan</label>
                <input type='text' name='Nama' id='Nama' />

                <label for='No_hp'>No_hp</label>
                <input type='text' name='No_hp' id='No_hp' />

                <label for="Shif">Shif</label>
                <select name="Shif" id="Shif">
                    <option value="08:00:00 - 12:00:00">08:00:00 - 12:00:00</option>
                    <option value="14:00:00 - 17:00:00">02:00:00 - 05:00:00</option>

                </select>

                <label for='Alamat'>Alamat</label>
                <textarea name="Alamat" id="Alamat"></textarea>
            </div>
            <div class="right-side">
                <input type="file" name="pic" id="file">
                <div class="preview"></div>
                <button class="upload">Upload</button>
            </div>

            <input type="submit" value="Tambah Karyawaan" name="tambah">

        </form>
    </main>

    <script type="module">
        import {
            navbar
        } from "./js/navbar.js";
        import {
            submitHandler
        } from "./script/submitHandler.js"
        import {
            FileHandler
        } from "./script/FileHandler.js"
        navbar();
        document.forms[0].onsubmit = e => {
            e.preventDefault()
            submitHandler()
        }
        FileHandler()
    </script>
</body>

</html>
<?php
if (count($_POST) > 0) {
    $conn = conn();
    HandleForm($conn, $_POST, $_FILES);
    if ($message) {
        echo "<script>alertify.alert('berhasill !! 🎊 🎊 🎊 ','yayy berhasil menambah karyawan baru nihh')</script>";
    } else {
        echo "<script>alertify.alert('gagal !!','gagal tambah data coba hubungi admin deh')</script>";
    }
}
?>