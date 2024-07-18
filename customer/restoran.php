<?php
include("connection.php");

$customer = $_GET["customer"];
$customer_sql = mysqli_query($connect, "SELECT * FROM customer INNER JOIN orders ON customer.Customer_ID = orders.Customer_ID;");
$custo = mysqli_fetch_all($customer_sql, MYSQLI_ASSOC);

$query = mysqli_query($connect, "SELECT * FROM restoran");
$restoran = mysqli_fetch_all($query, MYSQLI_ASSOC);
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
    <link rel="stylesheet" href="../css/swiper-bundle.min.css">

    <title>MakanKuy</title>
</head>
<body class="bg-gray-100">
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
        <main class="max-w-[1920px] mx-auto bg-background overflow-hidden">
            <!-- grid -->
            <div class="xl:bg-grid xl:bg-center xl:bg-repeat-y fixed top-0 bottom-0 left-0 right-0 z-10"></div>

            <!-- restoran -->
        <section class="restoran mt-[80px] xl:mt-[150px] relative z-20" id="berita">
            <div class="container mx-auto px-0">

                <!-- text -->
                <div class="text-center mb-[52px] max-w-[810px] mx-auto">
                    <h2 class="restoran__title mb-[70px] font-semibold text-5xl">Pilih Restoran Sesuai Seleramu!</h2>
                </div>

                <!-- grid -->
                <div class="restoran__grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-[27px]">
                <?php if(empty($restoran)): ?> 
                    <p>Tidak ada data restoran</p>
                <?php else: ?>
                    <!-- Grid Item -->
                    <?php foreach($restoran as $resto): ?>
                        <div class="restoran__item w-[267px] h-[328px] mb-[50px] rounded-[50px] transition-all group cursor-pointer
                        mx-auto xl:mx-0 shadow-lg flex flex-col justify-end text-center" 
                        style="background-image: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)), url(../uploads/<?php echo $resto['image']; ?>); background-size: cover;"
                        onclick="openPopup('<?php echo $resto['Restoran_ID']; ?>')">  
                            <h3 class= "text-background font-medium text-xl"><?php echo $resto['Name'] ?></h3>
                            <p class= "text-background font-thin text-lg mb-[45px]"><?php echo $resto['Location'] ?></p>
                        </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <!-- POP UP RESTORAN -->
                    <div id="popup" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center hidden">
                        <div class="bg-background p-6 rounded-lg shadow-lg relative w-11/12 md:w-1/2 lg:w-1/3 text-center">
                            <span class="absolute top-2 right-2 text-primary cursor-pointer text-5xl" onclick="closePopup()">&times;</span>
                            <h1 id="name" class="text-3xl font-bold mb-4 text-center"></h1>
                            <div class="flex flex-row">
                                <img id="image" src="" alt="Restoran" class="w-[170px] h-[200px] rounded-[15px] mb-4">
                                <div class="text-left mx-[20px]">
                                    <p id="location" class="text-primary mb-2 text-lg"></p>
                                    <p id="phone" class="text-primary mb-2 text-lg"></p>
                                    <p id="email" class="text-primary mb-2 text-lg"></p>
                                    <p id="description" class="text-primary mb-4 text-lg"></p>
                                </div>
                            </div>
                            <button id="order" class="btn-primary text-primary px-9 py-2 rounded-lg text-lg" onclick="orderNow()">Pesan Sekarang</button>
                        </div>
                    </div>

                    <script>
                        function openPopup(restoId) {
                            const restoran = <?php echo json_encode($restoran); ?>;
                            const resto = restoran.find(r => r.Restoran_ID === restoId);
                            
                            document.getElementById('name').textContent = resto.Name;
                            document.getElementById('location').textContent = 'Lokasi: ' + resto.Location;
                            document.getElementById('phone').textContent = 'No Telp: ' + resto.Phone;
                            document.getElementById('email').textContent = 'Email: ' + resto.Email;
                            document.getElementById('description').textContent = 'Deskripsi: ' + resto.Description;
                            document.getElementById('image').src = '../uploads/' + resto.image;

                            document.getElementById('order').setAttribute('data-resto', resto.Restoran_ID);

                            document.getElementById('popup').classList.remove('hidden');
                            document.getElementById('popup').classList.add('flex');
                        }

                        function closePopup() {
                            document.getElementById('popup').classList.add('hidden');
                            document.getElementById('popup').classList.remove('flex');
                        }

                        function orderNow() {
                            <?php if(empty($custo)): ?> 
                                const restoId = document.getElementById('order').getAttribute('data-resto');
                                window.location.href = 'pesan.php?id=' + restoId + '&customer=' + <?php echo $customer; ?>;
                            <?php else: ?>
                                alert('Kamu sudah memiliki order, tidak dapat melakukan order lagi');
                                window.location.href = 'hero.php?customer=<?php echo $customer; ?>';
                            <?php endif; ?>
                        }  
                    </script>


        </section>
        
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