<?php
session_start();

session_reset();
session_destroy();
session_unset();
$_SESSION['login'] = false;
$_SESSION['user'] = '';

if (!($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}
