<?php
session_start();
require_once "./layout/header.php";
require_once "./layout/nav.php";
require_once "./helper/conn.php";
require_once "./helper/Home_user.php";

date_default_timezone_set('Asia/Jayapura');

// buat koneksi 
$conn = conn();
// select user
$user = Home_user($conn, $_SESSION['user']);

if (isset($_GET['karyawan'])) {
    $karyawan = $_GET['karyawan'];
    $nama = $_GET['nama'];


    $stmt = $conn->prepare("SELECT karyawan.nama, absensi.tgl, absensi.absen, karyawan.id_karyawan FROM karyawan  JOIN absensi ON (karyawan.id_karyawan = absensi.id_karyawan) WHERE absensi.id_karyawan = ?");
    $stmt->execute([$karyawan]);
    $result = $stmt->get_result();
}

if (isset($_POST['absen'])) {
    $date = date("Y:m:d");
    $absen = $_POST['absen'];
    $stmt = $conn->prepare("UPDATE absensi SET absen = ? WHERE date = ?");
    $stmt->execute([$_POST['absen'], $date]);
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>absensi Upimart | detail absen</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
</head>

<body>

    <?php
    headers();
    nav($user['nama'], $user['pic']);
    ?>

    <main class="absen-page">
        <h2>Detail Absensi <?= $nama; ?></h2>
        <div class="alert alert-primary" role="alert">
            <strong>Important !!!</strong>
            jika tak ada perubahan setelah mengubah absen coba reload halaman ini
        </div>

        <div class="table-wrapper">
            <table class="table">
                <tr>
                    <th>NO</th>
                    <th>tgl</th>
                    <th>absen</th>
                    <th>action</th>
                </tr>
                <?php
                $no = 1;
                if ($result->num_rows > 0) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <?php
                                echo date("Y-m-d H:i:s", $row['tgl']);
                                ?>
                            </td>
                            <td><?= $row['absen']; ?></td>
                            <td>
                                <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    edit
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; ?>

                <?php endif; ?>
            </table>
        </div>
    </main>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Absensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="detail_absen.php?karyawan=<?= $karyawan ?>&nama=<?= $nama; ?>" method="post">
                        <select class="form-select" aria-label="Default select example" name="absen">
                            <option selected>-</option>
                            <option value="alpa">alpa</option>
                            <option value="sakit">sakit</option>
                            <option value="izin">izin</option>
                            <option value="hadir">Hadir</option>
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary mb-3">absen</button>
                </div>
                </form>
            </div>
        </div>
    </div>

</body>
<script type="module">
    import {
        navbar
    } from "./js/navbar.js";
    navbar();
</script>
<script src="./script/bootstrap.bundle.js"></script>

</html>