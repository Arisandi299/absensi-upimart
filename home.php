<?php
session_start();
require_once "./layout/header.php";
require_once "./layout/nav.php";
require_once "./helper/conn.php";
require_once "./helper/Home_user.php";


// check sudah login
if (!isset($_SESSION['login']) || $_SESSION['login'] == false  || $_SESSION['user'] == 'admin') {
    header("Location: login.php");
    exit;
}

// buat koneksi 
$conn = conn();
// select user
$user = Home_user($conn, $_SESSION['user']);

// shif
$shif = explode("-", $user['shif']);

// set timezone ke indonesia timur

date_default_timezone_set('Asia/Jayapura');

$absen = '';

// jangka waktu absen
$now = new DateTime();
// $start = new DateTime($shif[0]);
$start = new DateTime($shif[0]);
$end = new DateTime(date("H:i:s", strtotime("+15 minutes", $start->getTimestamp())));
// echo date("H:i:s", $start->getTimestamp());



// check absen;
$hadir = 0;
$sakit = 0;
$izin = 0;
$alpa  = 0;

// check absen 
$date = date("Y:m:d");
$stmt = $conn->prepare("SELECT absensi.absen from absensi where date = ? and id_karyawan = ?");
$stmt->execute([$date, $user['id_karyawan']]);
$result = $stmt->get_result();

$absen = $conn->prepare("SELECT absensi.absen from absensi where id_karyawan = ?");
$absen->execute([$user['id_karyawan']]);
$res = $absen->get_result();
while ($hasil = $res->fetch_assoc()) {
    switch ($hasil['absen']) {
        case "hadir":
            $hadir++;
            break;
        case "sakit":
            $sakit++;
            break;
        case "izin":
            $izin++;
            break;
        case "alpa":
            $alpa++;
    }
}






if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['absen'] == "hadir") {
        $absen = "hadir";
    }
    if ($row['absen'] == 'alpa') {
        $absen = "alpa";
    }
    if ($row['absen'] == 'sakit') {
        $absen = "sakit";
    }
    if ($row['absen'] == 'izin') {
        $absen = "izin";
    }
    if ($row['absen'] == 'sakit') {
        $absen = "sakit";
    }
} else {
    if ($now >= $start && $now <= $end) {
        $absen = "waiting";

        if (isset($_GET["absen"]) && $_GET['absen'] == "hadir") {
            $absen = "hadir";
            $tgl = $now->getTimestamp();
            $date =  date("Y:m:d", $tgl);
            $stmt = $conn->prepare("INSERT INTO absensi(id_karyawan,tgl,absen,date) VALUES (?,?,?,?)");

            $stmt->bind_param(
                "siss",
                $user['id_karyawan'],
                $tgl,
                $absen,
                $date
            );
            $stmt->execute();
        }
    } else if ($now > $end) {
        $absen = "alpa";
        $tgl = $now->getTimestamp();
        $date =  date("Y:m:d", $tgl);
        $stmt = $conn->prepare("INSERT INTO absensi(id_karyawan,tgl,absen,date) VALUES (?,?,?,?)");

        $stmt->bind_param(
            "siss",
            $user['id_karyawan'],
            $tgl,
            $absen,
            $date
        );
        $stmt->execute();
    } else if ($now < $start) {
        $absen = "wait";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <?php
    headers();
    nav($user['nama'], $user['pic']);
    ?>


    <main class="home-page">
        <h1 class="main-title">Hi <?= $user['nama']; ?> </h1>

        <?php if ($absen == "waiting") : ?>
            <div class="not-present">
                <img src="./img/wait.jpg" alt="sad-emoji" class="emoji">
                <span class="shif">shiff : <?php echo $user['shif'] ?></span>
                <span class="title">Kamu belum absen nihh, jika sakit atau izin kamu dapat minta izin di bawah

                    <p class="sisa-waktu"></p>
                </span>

                <div class="bottom-wrapper">
                    <button class="absen"><a href="./home.php?absen=hadir">Absen Sekarang</a></button>

                </div>
            </div>
        <?php endif; ?>
        <?php if ($absen == "wait") : ?>
            <div class="not-present">
                <img src="./img/wait.jpg" alt="sad-emoji" class="emoji">
                <span class="shif">shiff : <?php echo $user['shif'] ?></span>
                <span class="title">tunggu sampai jam shiff kamu baru bisa absen

                    <p class="sisa-waktu"></p>
                </span>

                <div class="bottom-wrapper">


                </div>
            </div>
        <?php endif; ?>

        <?php if ($absen == "hadir") : ?>
            <div class="not-present">
                <img src="./img/hadir.jpg" alt="sad-emoji" class="emoji">
                <span class="shif">shiff : <?php echo $user['shif'] ?></span>
                <span class="title">Kamu sudah Absen Kembali lagi Besok

                    <p class="sisa-waktu"></p>
                </span>
            </div>
        <?php endif; ?>

        <?php if ($absen == 'izin') : ?>
            <div class="not-present">
                <img src="./img/izin.jpg" alt="sad-emoji" class="emoji">
                <span class="shif">shiff : <?php echo $user['shif'] ?></span>
                <span class="title">Kamu sudah izin

                    <p class="sisa-waktu"></p>
                </span>
            </div>
        <?php endif; ?>
        <?php if ($absen == 'sakit') : ?>
            <div class="not-present">
                <img src="./img/izin.jpg" alt="sad-emoji" class="emoji">
                <span class="shif">shiff : <?php echo $user['shif'] ?></span>
                <span class="title">Kamu sudah mendaptkan izin sakit

                    <p class="sisa-waktu"></p>
                </span>
            </div>
        <?php endif; ?>
        <?php if ($absen == 'alpa') : ?>
            <div class="not-present">
                <img src="./img/alpa.jpg" alt="sad-emoji" class="emoji">
                <span class="shif">shiff : <?php echo $user['shif'] ?></span>
                <span class="title">Kamu sudah alpha

                    <p class="sisa-waktu"></p>
                </span>
            </div>
        <?php endif; ?>





        <div class="detail">
            <h4>Total absen</h4>
            <p class="hadir">Hadir : <?= $hadir; ?></p>
            <p class="hadir">Sakit : <?= $sakit; ?></p>
            <p class="hadir">Alpa : <?= $alpa; ?></p>
            <p class="hadir">izin : <?= $izin; ?></p>
        </div>

    </main>
    <script type="module">
        import {
            navbar
        } from "./js/navbar.js";

        navbar();

        window.history.replaceState(null, '', "home.php");

        const sisa_waktu = document.querySelector(".sisa-waktu");


        <?php
        // get timestap dari janga waktu
        $end_format  = $end->getTimestamp();
        $start_format = $start->getTimestamp();
        ?>

        // convert timestampt php ke javascript
        const end_format = <?= $end_format; ?> * 1000;
        const start_format = <?= $start_format; ?> * 1000;

        // waktu mulai (js)
        const end = new Date();
        end.setTime(end_format)
        // waktu akhrr (js)
        const start = new Date();
        start.setTime(start_format);
        console.log(start);

        // waktu tunggu absen selanjutnya 
        const next_absen = start;
        next_absen.setDate(next_absen.getDate() + 1);

        <?php if ($absen == "waiting") : ?>
            countdown(end, "reload jika tidak ada perubahan setelah waktu habis");
        <?php endif; ?>
        <?php if ($absen == "alpa") : ?>
            countdown(next_absen, "lagi untuk absen selajutnya")
        <?php endif; ?>
        <?php if ($absen == "hadir") : ?>
            countdown(next_absen, "lagi untuk absen selajutnya")
        <?php endif; ?>
        <?php if ($absen == "izin") : ?>
            countdown(next_absen, "lagi untuk absen selajutnya")
        <?php endif; ?>
        <?php if ($absen == "sakit") : ?>
            countdown(next_absen, "lagi untuk absen selajutnya")
        <?php endif; ?>
        <?php if ($absen == "wait") : ?>
            countdown(next_absen, "lagi untuk absen selajutnya")
        <?php endif; ?>

        // function countdown / sisa waktu
        function countdown(end, message) {
            const timeout = setInterval(() => {
                let now = new Date().getTime();
                let distance = end - now;

                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                sisa_waktu.textContent = `sisa waktu  ${hours} jam :  ${minutes} menit :  ${seconds} detik ${message} `;

                if (distance < 0) {
                    clearInterval(timeout);
                }

            }, 1000);


        }
    </script>
</body>

</html>