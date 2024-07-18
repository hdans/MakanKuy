<?php
include("connection.php");

$id = $_GET['id'];
$customer = $_GET['customer'];

$query = mysqli_query($connect, "SELECT * FROM menu WHERE Restoran_ID='$id'");
$menu = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="output.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <!-- Remix Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <title>MakanKuy</title>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Header -->
    <header class="sticky top-0 bg-white shadow-md z-30">
        <div class="container mx-auto flex justify-between items-center h-16 px-4">
            <!-- Logo -->
            <a href="hero.php?customer=<?php echo urlencode($customer); ?>" class="flex items-center">
                <img src="../assets/logo/full.png" alt="Logo" class="h-12">
            </a>
            <!-- Navigation -->
            <nav class="flex space-x-4">
                <a href="restoran.php?customer=<?php echo urlencode($customer); ?>" class="text-gray-700 hover:text-green-500 transition duration-300">Restoran</a>
                <a href="pesanan.php?customer=<?php echo urlencode($customer); ?>" class="text-gray-700 hover:text-green-500 transition duration-300">Pesanan</a>
                <a href="../login.php" class="text-gray-700 hover:text-green-500 transition duration-300">Logout</a>
            </nav>
        </div>
    </header>
    <!-- Main content -->
    <main class="container mx-auto py-10">
        <section class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold mb-6 text-center">Daftar Pesanan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if(empty($menu)): ?>
                    <p class="col-span-full text-center">Menu Tidak Tersedia</p>
                <?php else: ?>
                    <?php foreach($menu as $makan): ?>
                        <div class="bg-gray-50 rounded-lg shadow-md p-6 flex flex-col items-center">
                            <img src="../uploads/<?php echo $makan['image']; ?>" alt="<?php echo $makan['Food_name']; ?>" class="w-32 h-32 rounded-full mb-4 object-cover">
                            <h3 class="text-xl font-semibold"><?php echo $makan['Food_name']; ?></h3>
                            <p class="text-green-500 font-bold mt-2">Rp <?php echo number_format($makan['Price'], 0, ',', '.'); ?></p>
                            <p class="text-gray-600 mt-2"><?php echo $makan['Description']; ?></p>
                            <div class="flex items-center mt-4 space-x-2">
                                <button class="bg-green-500 text-white rounded-full p-2" onclick="addMenu(<?php echo $makan['Menu_ID']; ?>, <?php echo $makan['Price']; ?>)"><i class="ri-add-line"></i></button>
                                <span id="count-<?php echo $makan['Menu_ID']; ?>" class="text-xl">0</span>
                                <button class="bg-red-500 text-white rounded-full p-2" onclick="removeMenu(<?php echo $makan['Menu_ID']; ?>, <?php echo $makan['Price']; ?>)"><i class="ri-subtract-line"></i></button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="mt-10 text-center">
                <button class="bg-green-500 text-white px-8 py-4 rounded-full text-3xl" onclick="confirmOrder()">Pesan</button>
            </div>
        </section>
    </main>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- AJAX functions -->
    <script>
        let orderDetails = {};

        function addMenu(menuId, price) {
            if (orderDetails[menuId]) {
                orderDetails[menuId].quantity += 1;
            } else {
                orderDetails[menuId] = {
                    quantity: 1,
                    price: price
                };
            }
            $('#count-' + menuId).text(orderDetails[menuId].quantity);
        }

        function removeMenu(menuId, price) {
            if (orderDetails[menuId] && orderDetails[menuId].quantity > 0) {
                orderDetails[menuId].quantity -= 1;
                $('#count-' + menuId).text(orderDetails[menuId].quantity);
                if (orderDetails[menuId].quantity === 0) {
                    delete orderDetails[menuId];
                }
            }
        }

        function confirmOrder() {
            $.ajax({
                url: 'confirm_order.php',
                type: 'POST',
                data: {
                    customer_id: '<?php echo $customer; ?>',
                    order_details: JSON.stringify(orderDetails)
                },
                success: function(response) {
                    alert("Pesanan Anda telah dikonfirmasi!");
                    window.location.href = 'hero.php?customer=<?php echo $customer; ?>';
                }
            });
        }
    </script>
</body>
</html>
