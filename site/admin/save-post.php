<?php
session_start();
include "config.php";

if (isset($_FILES['fileToUpload'])) {
    $errors = array();

    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $extensions = array("jpeg", "jpg", "png");

    if (!in_array($file_ext, $extensions)) {
        $errors[] = "This extension file not allowed, please choose a JPG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = "File size must be 2MB or lower.";
    }

    $new_name = time() . "-" . basename($file_name);
    $target = "upload/" . $new_name;

    if (empty($errors)) {
        if (move_uploaded_file($file_tmp, $target)) {
            // Si la subida fue exitosa, continuar
            $title = mysqli_real_escape_string($connection, $_POST['post_title']);
            $description = mysqli_real_escape_string($connection, $_POST['postdesc']);
            $category = (int) $_POST['category']; // Asegúrate de que es un entero
            $date = date("d M, Y");
            $author = $_SESSION['user_id'];

            // Preparar la consulta para evitar inyección SQL
            $sql = "INSERT INTO post (title, description, category, post_date, author, post_img) VALUES ('{$title}', '{$description}', {$category}, '{$date}', {$author}, '{$new_name}');";
            $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$category};";

            if (mysqli_multi_query($connection, $sql)) {
                header("Location: post.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Query Failed: " . mysqli_error($connection) . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Error uploading file.</div>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>{$error}</div>";
        }
    }
}
?>
