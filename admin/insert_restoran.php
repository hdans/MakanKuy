<?php
include("connection.php");

if (!empty($_POST)) {
    $Name = $_POST["Name"];
    $Location = $_POST["Location"];
    $Phone = $_POST["Phone"];
    $Email = $_POST["Email"];
    $Description = $_POST["Description"];
    $image = $_FILES['image']['name'];

    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
        } else {

            if ($_FILES["image"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
            } else {
    
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                } else {
        
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $stmt = $connect->prepare("INSERT INTO restoran (Name, Location, Phone, Email, Description, image) VALUES (?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("ssssss", $Name, $Location, $Phone, $Email, $Description, $image);

                        if ($stmt->execute()) {
                            header('Location: tables.php');
                        } else {
                            echo 'Input gagal';
                        }

                        $stmt->close();
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }
    } else {
        echo "File is not an image.";
    }
} else {
    echo "Tidak masuk";
}

$connect->close();
?>
