<?php
include("connection.php");

$id = $_GET['id'];

$query = mysqli_query($connect, "SELECT * FROM restoran WHERE Restoran_ID='$id' LIMIT 1");
$restoran_data = mysqli_fetch_assoc($query);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $column = $_POST['column'];
    $value = $_POST['value'];

    if ($column === 'image' && isset($_FILES['image'])) {
        $image = $_FILES['image'];
        $image_name = $image['name'];
        $image_tmp_name = $image['tmp_name'];
        $image_path = "../uploads/" . $image_name;

        // Move the uploaded file to the desired directory
        move_uploaded_file($image_tmp_name, $image_path);

        // Update the database with the new image filename
        $update_query = "UPDATE restoran SET image='$image_name' WHERE Restoran_ID='$id'";
        mysqli_query($connect, $update_query);
    } else {
        // Menyimpan data yang diupdate ke database
        $update_query = "UPDATE restoran SET $column='$value' WHERE Restoran_ID='$id'";
        mysqli_query($connect, $update_query);
    }

    // Mengarahkan kembali ke halaman tabel restoran setelah update
    header("Location: tables.php");
    exit();
}
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
<body class="bg-gray-100">

<div class="container mx-auto p-6">

  <section class="mb-6">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
      <h1 class="text-3xl font-semibold">Form Update Restoran</h1>
    </div>
  </section>

  <section class="mb-6">
    <div class="bg-white shadow rounded-lg p-6">
      <header class="border-b border-gray-200 mb-4 pb-4">
        <h2 class="text-xl font-semibold">Pilih Bagian yang ingin diupdate</h2>
      </header>
      <form action="" method="post">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm mb-2" for="column">
            Pilih Kolom
          </label>
          <select name="column" class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            <?php foreach ($restoran_data as $key => $value) { ?>
              <?php if ($key !== 'Restoran_ID' && $key !== 'image') { ?>
                <option value="<?php echo $key; ?>"><?php echo ucfirst($key); ?></option>
              <?php } ?>
            <?php } ?>
            <option value="image">Image</option>
          </select>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">Pilih</button>
      </form>
    </div>
  </section>

  <?php if (isset($_POST['column'])) { ?>
  <section class="mb-6">
    <div class="bg-white shadow rounded-lg p-6">
      <header class="border-b border-gray-200 mb-4 pb-4">
        <h2 class="text-xl font-semibold">Update Detail Restoran</h2>
      </header>
      <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="column" value="<?php echo $_POST['column']; ?>">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm mb-2" for="value">
            <?php echo ucfirst($_POST['column']); ?>
          </label>
          <?php $column_name = $_POST['column']; ?>
          <?php if ($column_name === 'image') { ?>
            <input type="file" name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
          <?php } elseif ($column_name === 'Description') { ?>
            <textarea name="value" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo $restoran_data[$column_name]; ?></textarea>
          <?php } else { ?>
            <input type="text" name="value" value="<?php echo $restoran_data[$column_name]; ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          <?php } ?>
        </div>
        <button type="submit" name="update" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
      </form>
    </div>
  </section>
  <?php } ?>

  <footer class="mt-6 text-center text-gray-500">
    © 2024, MakanKuy
  </footer>
</div>

</body>
</html>
