<?php
include("connection.php");

$customer = $_GET['customer'];

$orders_query = mysqli_query($connect, "SELECT * FROM orders WHERE Customer_ID = $customer");
$orders = mysqli_fetch_all($orders_query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" href="../css/output.css">
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.min.css">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Hebrew:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Hebrew:wght@100;200;300;400;500;600;700&family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <!-- swiper -->
    <link rel="stylesheet" href="css/swiper-bundle.min.css">

    <title>MakanKuy</title>
    <style>
        .table-auto th, .table-auto td {
            text-align: left;
            padding: 8px;
        }
        .order-section {
            margin-bottom: 40px;
        }
        .order-section h3 {
            margin-bottom: 20px;
        }
        .order-section table {
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="bg-white">
    <!-- Header -->
    <header class="sticky h-[90px] top-0 bg-background shadow-xl z-30">
            <div class="container mx-auto flex justify-between h-full items-center">
                <!-- logo -->
                <div class="">
                    <a href="hero.php?customer=<?php echo urlencode($customer); ?>" class="flex flex-row items-center gap-3">
                        <img class="h-[85px]" src="../assets/logo/full.png" alt="Logo">
                    </a>
                </div>
                <!-- nav -->
                <nav class="inline">
                    <!-- nav trigger -->
                    <div class="cursor-pointer lg:hidden" id="nav_trigger_btn">
                        <i class="ri-menu-4-line text-4xl text-primary"></i>
                    </div>
                    <ul class="fixed h-0 w-full bg-background overflow-hidden border-t top-[90px] flex flex-col gap-4 lg:gap-16 left-0 
                    right-0 lg:relative lg:flex-row lg:p-0 lg:top-0 lg:border-none lg:h-full transition-all duration-300 nav_btn"
                    id="nav_menu">
                        <li><a href="restoran.php?customer=<?php echo urlencode($customer); ?>" class="duration-300 text-xl text-primary">Restoran</a></li>
                        <li><a href="pesanan.php?customer=<?php echo urlencode($customer); ?>" class="duration-300 text-xl text-primary">Pesanan</a></li>
                        <li><a href="../login.php" class="duration-300 text-xl text-primary">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </header>
    <!-- page wrapper -->
    <main class="max-w-[1920px] mx-auto bg-white overflow-hidden">
        <!-- grid -->
        <div class="xl:bg-grid xl:bg-center xl:bg-repeat-y fixed top-0 bottom-0 left-0 right-0 z-10"></div>

        <section class="restoran mt-[30px] xl:mt-[80px] relative z-20" id="berita">
            <div class="container mx-auto px-0">
                <div class="text-center mb-[52px] max-w-[810px] mx-auto">
                    <h2 class="restoran__title mb-[70px] font-semibold text-5xl">Pesanan Saya</h2>
                </div>
                
                <?php if(empty($orders)): ?> 
                    <p class="text-center">Tidak ada pesanan</p>
                <?php else: ?>
                    <?php foreach($orders as $order_index => $order): ?>
                        <?php
                        // Get the restaurant name for the current order
                        $restaurant_query = mysqli_query($connect, "
                            SELECT r.Name 
                            FROM restoran r
                            JOIN menu m ON r.Restoran_ID = m.Restoran_ID
                            JOIN order_details od ON m.Menu_ID = od.Menu_ID
                            WHERE od.Order_ID = '" . $order['Order_ID'] . "'
                            LIMIT 1
                        ");
                        $restaurant_result = mysqli_fetch_assoc($restaurant_query);
                        $restaurant_name = $restaurant_result['Name'];
                        
                        // Get the order details for the current order
                        $order_details_query = mysqli_query($connect, "
                            SELECT order_details.*, menu.Food_name 
                            FROM order_details
                            JOIN menu ON order_details.Menu_ID = menu.Menu_ID
                            WHERE order_details.Order_ID = '" . $order['Order_ID'] . "'
                        ");
                        $order_details = mysqli_fetch_all($order_details_query, MYSQLI_ASSOC);

                        // Calculate total bill for the current order
                        $total_bill = array_reduce($order_details, function($carry, $item) {
                            return $carry + ($item['Price'] * $item['Quantity']);
                        }, 0);
                        ?>
                        
                        <div class="order-section mb-12">
                            <h3 class="text-2xl font-bold mb-4">Restoran <?php echo $restaurant_name; ?></h3>
                            <table class="table-auto w-full mb-6">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Menu</th>
                                        <th>Jumlah</th>
                                        <th>Harga Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($order_details as $index => $detail): ?>
                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td><?php echo $detail['Food_name']; ?></td>
                                            <td><?php echo $detail['Quantity']; ?></td>
                                            <td>Rp. <?php echo number_format($detail['Price'] * $detail['Quantity'], 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="text-center">
                                <h3 class="text-3xl font-bold mb-4">Total Bill: Rp. <?php echo number_format($total_bill, 0, ',', '.'); ?></h3>
                                <p class="mb-4">Pembayaran akan dilakukan di kasir Restoran pilihanmu</p>
                                <button class="btn-primary text-primary px-9 py-2 rounded-lg text-lg" onclick="confirmOrder(<?php echo $order['Order_ID']; ?>)">Pesanan Selesai</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <script>
                    function confirmOrder(orderId) {
                        if (confirm("Apakah Anda yakin ingin menyelesaikan pesanan ini?")) {
                            fetch('delete_order.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({ orderId: orderId }),
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert("Pesanan selesai! Silakan lakukan pembayaran di kasir.");
                                    window.location.reload(); // Reload halaman setelah penghapusan berhasil
                                } else {
                                    alert("Gagal menghapus pesanan. Silakan coba lagi.");
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert("Terjadi kesalahan. Silakan coba lagi.");
                            });
                        }
                    }
                </script>
            </div>
        </section>
    </main>

    <!-- scroll reveal -->
    <script src="../js/scrollreveal.min.js"></script>
    <!-- Swiper -->
    <script src="../js/swiper-bundle.min.js"></script>
    <!-- Main -->
    <script src="../js/main.js"></script>
</body>
</html>