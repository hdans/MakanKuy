<?php

include('connection.php');

$id = $_GET['id']; 

$menu = mysqli_query($connect, "SELECT * FROM Menu WHERE Menu_ID='$id' LIMIT 1");
$menu = mysqli_fetch_array($menu);

$resto_id = $menu["Restoran_ID"];

mysqli_query($connect, "SET FOREIGN_KEY_CHECKS=0");

$delete_Menu = mysqli_query($connect, "DELETE FROM Menu WHERE Menu_ID='$id' LIMIT 1");

mysqli_query($connect, "SET FOREIGN_KEY_CHECKS=1");

if ($delete_Menu) {
    header('Location: menu.php?id=' . $resto_id);
    exit();
} else {
    echo 'Delete data Menu gagal';
}
?>
