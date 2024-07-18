<?php
include("connection.php");

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$order_id = $data['orderId'];

if (isset($order_id)) {
    mysqli_begin_transaction($connect);

    try {

        $delete_order_details_query = "DELETE FROM order_details WHERE Order_ID = ?";
        $stmt = mysqli_prepare($connect, $delete_order_details_query);
        mysqli_stmt_bind_param($stmt, 'i', $order_id);
        mysqli_stmt_execute($stmt);

        $delete_order_query = "DELETE FROM orders WHERE Order_ID = ?";
        $stmt = mysqli_prepare($connect, $delete_order_query);
        mysqli_stmt_bind_param($stmt, 'i', $order_id);
        mysqli_stmt_execute($stmt);

        mysqli_commit($connect);

        echo json_encode(['success' => true]);
    } catch (Exception $e) {

        mysqli_rollback($connect);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid order ID']);
}
?>
