<?php
session_start();
require_once "./layout/header.php";
require_once "./layout/nav.php";
require_once "./helper/Home_user.php";
require_once "./helper/conn.php";

$message = '';

if (!isset($_SESSION['login']) || $_SESSION['login'] == false || $_SESSION['user'] != 'admin') {
  header("Location: login.php");
  exit;
}
$conn = conn();

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $query = $conn->prepare("delete from karyawan where id_karyawan = ?");
  $query->execute([$id]);
  if ($query->affected_rows > 0) {
    $message = true;
  }
}
$user = Home_user($conn, $_SESSION['user']);
$stmt = $conn->prepare("select * from karyawan");
$stmt->execute();
$result = $stmt->get_result();
$conn->close();





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
<link rel="stylesheet" href="./css/bootstrap.css">
<style>
  a {
    color: inherit !important;
    text-decoration: none;
  }
</style>
</head>

<body>

  <?php
  headers();
  nav($user['nama'], $user['pic']);
  ?>


  <main class="dashboard-page">
    <?php if ($message)  echo '<div class="alert alert-danger" role="alert">
    berhasil hapus karyawan
  </div>'  ?>
    <h1 class="main-title">Dashboard Admin </h1>
    <button class="tambah"><a href="add_karyawan.php">Tambah Karyawan</a></button>
    <h2>Daftar Karyawan</h2>

    <div class="table-wrapper">
      <table class="table">
        <tr>
          <th>NO</th>
          <th>Nama</th>
          <th>No.Hp</th>
          <th>Alamat</th>
          <th>Shif</th>
          <td>Detail absen</td>
          <th>action</th>
        </tr>

        <?php
        $no = 1;
        if ($result->num_rows > 0) : ?>
          <?php while ($row = $result->fetch_assoc()) : ?>
            <?php if ($row['nama'] == 'admin') {
              continue;
            } ?>


            <tr>
              <td><?= $no++; ?></td>
              <td><?= $row['nama']; ?></td>
              <td><?= $row['hp']; ?></td>
              <td><?= $row['alamat']; ?></td>
              <td><?= $row["shif"]; ?></td>
              <td>
                <div class="button-wrapper">
                  <button class="btn-detail-absen"><a href="detail_absen.php?karyawan=<?= $row['id_karyawan'] ?>&nama=<?= $row['nama']; ?>">Detail Absen</a> </button>
                </div>
              </td>
              <td class="button-wrapper">
                <button class="delete"><a href="dashboard.php?delete=<?= $row['id_karyawan'] ?>">Delete</a></button>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php endif; ?>
      </table>
    </div>

  </main>

  </div>
  <script src="./script/bootstrap.bundle.js"></script>
  <script type="module">
    import {
      navbar
    } from "./js/navbar.js";
    navbar();
  </script>
</body>

</html>