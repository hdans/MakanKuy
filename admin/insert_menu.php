<?php
include("connection.php");

if (!empty($_POST)) {
    $Food_name = $_POST["Food_name"];
    $Price = $_POST["Price"];
    $Description = $_POST["Description"];
    $Restoran_ID = $_POST["Restoran_ID"];
    $image = $_FILES['image']['name'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            exit();
        }

        if ($_FILES["image"]["size"] > 2000000) {
            echo "Sorry, your file is too large.";
            exit();
        }

        $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
        if (!in_array($imageFileType, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            exit();
        }

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $stmt = $connect->prepare("INSERT INTO menu (Food_name, Price, Description, Restoran_ID, Image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sdsss", $Food_name, $Price, $Description, $Restoran_ID, $image);

            if ($stmt->execute()) {
                header('Location: menu.php?id=' . $Restoran_ID);
                exit();
            } else {
                echo 'Input gagal: ' . $stmt->error;
            }
        } else {
            echo 'Gagal mengupload gambar.';
        }
    } else {
        echo 'Gambar tidak ditemukan atau terjadi kesalahan saat upload.';
    }
} else {
    echo "Tidak ada data yang dikirim.";
}
?>
