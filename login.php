<?php
$servername = "localhost";
$dbusername = "danish";
$dbpassword = "danishganteng";
$dbname = "makankuy";

$connect = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($role == 'admin') {
        $sql = "INSERT INTO admin (Name, Phone, Email, username, password) VALUES ('$name', '$phone', '$email', '$username', '$password')";
    } else {
        $sql = "INSERT INTO customer (Name, Phone, Email, username, password) VALUES ('$name', '$phone', '$email', '$username', '$password')";
    }

    if ($connect->query($sql) === TRUE) {
        echo "<script>alert('Registration successful!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['login'])) {
    $username = $_GET['login'];
    $password = $_GET['password'];

    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        echo "<script>window.location.href='admin/tables.php';</script>";
        exit();
    } else {
        $sql = "SELECT * FROM customer WHERE username='$username' AND password='$password'";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); 
            $id = $row['Customer_ID']; 
            echo "<script>window.location.href='customer/hero.php?customer=$id';</script>";
            exit();
        } else {
            echo "<script>alert('Invalid username or password');</script>";
        }
    }
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en" class="form-screen">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - MakanKuy</title>

  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    .modal {
      transition: opacity 0.25s ease;
    }
    .modal-active {
      display: flex;
      align-items: center;
      justify-content: center;
      backdrop-filter: blur(5px);
    }
  </style>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">

<div id="app" class="w-full max-w-lg mx-auto p-5 bg-white rounded-lg shadow-lg">

  <section class="main-section">
    <div class="card">
      <header class="card-header mb-5 text-center">
        <h2 class="text-2xl font-semibold">Login</h2>
      </header>
      <div class="card-content">
        <form method="get" action="login.php">

          <div class="field mb-4">
            <label class="label">Login</label>
            <div class="control">
              <input class="input w-full px-4 py-2 border rounded-lg" type="text" name="login" placeholder="username" autocomplete="username" required>
            </div>
            <p class="help text-gray-600 text-sm">Please enter your login</p>
          </div>

          <div class="field mb-4">
            <label class="label">Password</label>
            <div class="control">
              <input class="input w-full px-4 py-2 border rounded-lg" type="password" name="password" placeholder="Password" autocomplete="current-password" required>
            </div>
            <p class="help text-gray-600 text-sm">Please enter your password</p>
          </div>

          <div class="field mb-4">
            <button type="submit" class="w-full py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">Login</button>
          </div>
          <div class="field">
            <button type="button" class="w-full py-2 px-4 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition" onclick="toggleModal()">Register</button>
          </div>

        </form>
      </div>
    </div>
  </section>

  <div id="register-modal" class="modal fixed inset-0 hidden">
    <div class="modal-overlay absolute inset-0 bg-gray-900 opacity-50"></div>
    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
      <div class="modal-content py-4 text-left px-6">
        <!-- Modal Header -->
        <div class="flex justify-between items-center pb-3">
          <p class="text-2xl font-bold">Register</p>
          <div class="modal-close cursor-pointer z-50" onclick="toggleModal()">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9l4.47-4.47z"/>
            </svg>
          </div>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
          <form method="post" action="login.php">
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
              <input type="text" name="name" placeholder="Name" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone</label>
              <input type="text" name="phone" placeholder="Phone" class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
              <input type="email" name="email" placeholder="Email" class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label>
              <input type="text" name="username" placeholder="Username" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
              <input type="password" name="password" placeholder="Password" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="role">Role</label>
              <select name="role" required class="w-full px-4 py-2 border rounded-lg">
                <option value="customer">Customer</option>
                <option value="admin">Admin</option>
              </select>
            </div>
            <div class="flex justify-end pt-2">
              <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">Register</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

<script>
  function toggleModal() {
    const body = document.querySelector('body');
    const modal = document.getElementById('register-modal');
    modal.classList.toggle('hidden');
    modal.classList.toggle('modal-active');
    body.classList.toggle('modal-active');
  }
</script>
</body>
</html>
