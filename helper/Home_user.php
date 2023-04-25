<?php
function Home_user($conn, $user)
{
    $stmt = $conn->prepare("SELECT * FROM karyawan WHERE nama = ? ");
    $stmt->execute([$user]);

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    return $user;
}
