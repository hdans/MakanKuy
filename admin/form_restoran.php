<!DOCTYPE html>
<html lang="en" class="">
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
<body class="bg-gray-100">

<div id="app" class="p-6">

  <section class="mb-6">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
      <h1 class="text-3xl font-semibold">Form tambah restoran</h1>
    </div>
  </section>

  <section>
    <div class="bg-white shadow rounded-lg overflow-hidden p-6">
      <header class="p-4 bg-gray-50 border-b border-gray-200 mb-4">
        <h2 class="text-xl font-semibold">Isi Restoran</h2>
      </header>
      <form action="insert_restoran.php" method="post" enctype="multipart/form-data">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
            Nama Restoran
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="Name" type="text" placeholder="Nama Restoran" required>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="location">
            Lokasi
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="location" name="Location" type="text" placeholder="Lokasi" required>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
            No. Telp
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone" name="Phone" type="text" placeholder="No. Telp" required>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
            Email
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="Email" type="email" placeholder="Email" required>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
            Deskripsi Restoran
          </label>
          <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="Description" placeholder="Deskripsi Restoran" required></textarea>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
            Foto Restoran
          </label>
          <div class="flex items-center">
            <label class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">
              Upload
              <input type="file" name="image" class="hidden" id="image" required>
            </label>
          </div>
        </div>
        <div class="flex items-center justify-between">
          <button class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Submit
          </button>
        </div>
      </form>
    </div>
  </section>

  <footer class="mt-6">
    <div class="text-center text-gray-500">
      © 2024, MakanKuy
    </div>
  </footer>

</div>

</body>
</html>
