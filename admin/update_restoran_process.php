<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['Name'];
    $location = $_POST['Location'];
    $phone = $_POST['Phone'];
    $email = $_POST['Email'];
    $description = $_POST['Description'];
    $old_image = $_POST['old_image'];
    $image = $old_image;

    if ($_FILES['Image']['name']) {
        $image = $_FILES['Image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file);
    }

    $query = "UPDATE restoran SET Name='$name', Location='$location', Phone='$phone', Email='$email', Description='$description', Image='$image' WHERE id='$id'";
    if (mysqli_query($connect, $query)) {
        header("Location: tables.php");
    } else {
        echo "Error updating record: " . mysqli_error($connect);
    }
}
?>
