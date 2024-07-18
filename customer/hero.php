<?php
include("connection.php");

$customer = $_GET["customer"];
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

            <section class="relative z-20 mt-8">
                <div class="container mx-auto xl:px-0"> 
                    <div class="flex flex-col xl:flex-row text-center xl:text-left 
                    justify-between items-center gap-8 xl:gap-[74px]">
                        <!-- text -->
                        <div class="about__text flex-1 order-1 xl:order-none max-w-xl xl:max-w-[410px] flex flex-col
                        items-center xl:items-start gap-8 xsm:max-w-[350px]">
                            <h1 class="font-extrabold text-[61px]">Gak perlu repot ngantri, Pesen aja di <span class="text-accent">MakanKuy!</span></h1>
                            <!-- button -->
                            <button class="btn bg-slate-800 mx-auto lg:mx-0 hover:bg-slate-200 hover:text-slate-900 hover:shadow-md focus:ring focus:ring-accent transition duration-300"
                            onclick="window.open('', '_blank')">Hubungi kami
                                <i class="ri-arrow-right-line text-accent"></i>
                            </button>
                        </div>
                        <!-- img -->
                        <div class="about__img max-w-[453px] order-2 xl:order-none
                        mx-auto xl:max-w-none xl:mx-0">
                        <img class="w-[600px]" src="../assets/hero/makan.png" alt="about">
                    </div>

                    </div>
                </div>
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