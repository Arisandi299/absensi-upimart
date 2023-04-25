<?php
function HandleForm($conn, $post, $file)
{

    global $message;
    $id_user = 1;
    $Nama = $post['Nama'];
    $No_hp = $post["No_hp"];
    $Shiff = $post['Shif'];
    $Alamat = $post["Alamat"];
    $file = $file['pic'];
    $image =  $image = $Nama . "." . image($file);

    $conn->begin_transaction();

    try {
        $karyawan = $conn->prepare("INSERT INTO karyawan (nama,hp,alamat,shif,pic) VALUES(?,?,?,?,?)");
        $karyawan->bind_param('sssss', $Nama, $No_hp, $Alamat, $Shiff, $image);
        $karyawan->execute();

        $id = $conn->insert_id;

        $user = $conn->prepare("INSERT INTO user (username,password,id_karyawan) values (?,?,?)");
        $user->execute([$Nama, $Nama, $id]);

        $conn->commit();

        if ($karyawan->affected_rows > 0 & file_handling($file, $image)) {
            $message = true;
        }
    } catch (mysqli_sql_exception  $e) {
        $conn->rollback();
    } finally {
        $conn->close();
    }
}

function file_handling($file, $name)
{
    $dir = "user_pic/";
    return move_uploaded_file($file["tmp_name"], $dir . $name);
}


function image($file)
{
    $type = explode("/", $file['type']);
    return $type[1];
}
