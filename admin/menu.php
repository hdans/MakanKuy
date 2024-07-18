<?php
include("connection.php");

$id = $_GET['id'];

$query = mysqli_query($connect, "SELECT * FROM menu WHERE Restoran_ID='$id'");
$menu = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Database Restoran</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Hebrew:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Hebrew:wght@100;200;300;400;500;600;700&family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

<div id="app">

<section class="mb-6">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
    <h1 class="text-3xl font-semibold">Tabel Menu</h1>
    <div class="flex space-x-4">
      <button class="bg-green-500 text-white px-4 py-2 rounded" onclick="location.href='form_menu.php?id=<?php echo $id; ?>'">Tambah Menu</button>
      <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="location.href='tables.php'">Kembali ke Restoran</button>
    </div>
  </div>
</section>

<section>
  <div class="bg-white shadow rounded-lg overflow-hidden">
    <header class="p-4 bg-gray-50 border-b border-gray-200">
      <h2 class="text-xl font-semibold">Menu</h2>
    </header>
    <div class="p-4 overflow-x-auto">
      <table class="min-w-full bg-white">
        <thead>
          <tr>
            <th class="p-4 text-left">Gambar</th>
            <th class="p-4 text-left">Nama</th>
            <th class="p-4 text-left">Harga</th>
            <th class="p-4 text-left">ID</th>
            <th class="p-4 text-left">Deskripsi</th>
            <th class="p-4 text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if(empty($menu)): ?>
            <tr>
              <td colspan="6" class="p-4 text-center text-red-500">Empty table. Nothing's here…</td>
            </tr>
          <?php else: ?>
            <?php foreach($menu as $makanan): ?>
              <tr>
                <td class="p-4"><img src="../uploads/?php echo $makanan['Image']; ?>" alt="<?php echo $makanan['Food_name']; ?>" class="w-16 h-16 object-cover rounded-full"></td>
                <td class="p-4"><?php echo $makanan['Food_name']?></td>
                <td class="p-4"><?php echo $makanan['Price']?></td>
                <td class="p-4"><?php echo $makanan['Menu_ID']?></td>
                <td class="p-4"><?php echo $makanan['Description']?></td>
                <td class="p-4 text-right">
                  <div class="flex space-x-2 justify-end">
                    <button class="bg-green-500 text-white px-3 py-2 rounded" onclick="location.href='form_update_menu.php?id=<?php echo $makanan['Menu_ID']?>'">
                      <i class="mdi mdi-square-edit-outline"></i>
                    </button>
                    <button class="bg-red-500 text-white px-3 py-2 rounded" onclick="location.href='delete_menu.php?id=<?php echo $makanan['Menu_ID']?>'">
                      <i class="mdi mdi-trash-can"></i>
                    </button>
                  </div>
                </td> 
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<footer class="mt-6">
  <div class="text-center text-gray-500">
    © 2024, MakanKuy
  </div>
</footer>

</div>

<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>
</html>
