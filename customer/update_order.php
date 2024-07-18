<?php
include("connection.php");

$action = $_POST['action'];
$order_id = $_POST['order_id'];
$menu_id = $_POST['menu_id'];
$price = $_POST['price'];

if ($action == 'add') {
    $check_query = mysqli_query($connect, "SELECT * FROM order_details WHERE Order_ID='$order_id' AND Menu_ID='$menu_id'");
    if (mysqli_num_rows($check_query) > 0) {
        mysqli_query($connect, "UPDATE order_details SET Quantity = Quantity + 1 WHERE Order_ID='$order_id' AND Menu_ID='$menu_id'");
    } else {
        mysqli_query($connect, "INSERT INTO order_details (Order_ID, Menu_ID, Quantity, Price) VALUES ('$order_id', '$menu_id', 1, '$price')");
    }
} elseif ($action == 'remove') {
    $check_query = mysqli_query($connect, "SELECT * FROM order_details WHERE Order_ID='$order_id' AND Menu_ID='$menu_id'");
    if (mysqli_num_rows($check_query) > 0) {
        $row = mysqli_fetch_assoc($check_query);
        if ($row['Quantity'] > 1) {
            mysqli_query($connect, "UPDATE order_details SET Quantity = Quantity - 1 WHERE Order_ID='$order_id' AND Menu_ID='$menu_id'");
        } else {
            mysqli_query($connect, "DELETE FROM order_details WHERE Order_ID='$order_id' AND Menu_ID='$menu_id'");
        }
    }
}
?>