<?php

include('connection.php');

$id = $_GET['id']; 

mysqli_query($connect, "SET FOREIGN_KEY_CHECKS=0");

$delete_restoran = mysqli_query($connect, "DELETE FROM restoran WHERE Restoran_ID='$id' LIMIT 1");

mysqli_query($connect, "SET FOREIGN_KEY_CHECKS=1");

if ($delete_restoran) {
    header('Location: tables.php');
    exit();
} else {
    echo 'Delete data restoran gagal';
}
?>
