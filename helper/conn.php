<?php 
function conn(){
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "absensi_upimart";
    return new mysqli($host,$user,$pass,$db);
}
