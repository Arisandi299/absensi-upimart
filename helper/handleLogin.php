<?php

function handlelogin($conn, $user, $pass)
{
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ? ");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['login'] = true;
        $user = $result->fetch_assoc();
        $_SESSION['user'] = $user['username'];

        if ($user['username'] == 'admin') {
            header("Location: dashboard.php");
            $conn->close();
            exit;
        } else {
            header("Location: home.php");
            $conn->close();
            exit;
        }
        return;
    } else {
        echo "<script>alertify.alert('eemm  🤔 coba lagi deh',  'mungkin ada yang salah di password atau username 🧐')</script>";
    }

    $conn->close();
}
