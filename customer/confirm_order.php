<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];
    $order_details = json_decode($_POST['order_details'], true);

    $insert_order = mysqli_query($connect, "INSERT INTO orders (Order_date, Total_amount, Customer_ID) VALUES (CURRENT_TIMESTAMP(), 0.00, $customer_id)");
    $order_id = mysqli_insert_id($connect);

    $total_amount = 0;

    foreach ($order_details as $menu_id => $details) {
        $quantity = $details['quantity'];
        $price = $details['price'];
        $amount = $quantity * $price;
        $total_amount += $amount;

        $insert_order_details = mysqli_query($connect, "INSERT INTO order_details (Order_ID, Menu_ID, Quantity, Price) VALUES ($order_id, $menu_id, $quantity, $amount)");
    }

    $update_order = mysqli_query($connect, "UPDATE orders SET Total_amount = $total_amount WHERE Order_ID = $order_id");

    if ($insert_order && $insert_order_details && $update_order) {
        echo "Pesanan berhasil dibuat.";
    } else {
        echo "Terjadi kesalahan saat membuat pesanan.";
    }
}
?>
