<?php
//session_start();
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $available_copies = $_POST['available_copies'];

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = $_FILES['photo'];
        $photoName = time() . "_" . basename($photo['name']);
        $photoTmpName = $photo['tmp_name'];
        $photoPath = "bookimages/" . $photoName;

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($photo['type'], $allowedTypes)) {
            $_SESSION['message'] = "Only .jpeg, .jpg, .png, and .gif images are allowed.";
            $_SESSION['message_type'] = "danger";
            header("Location: addbook.php");
            exit();
        }

        if ($photo['size'] > 400 * 1024) {
            $_SESSION['message'] = "Image size must be less than 400 KB.";
            $_SESSION['message_type'] = "danger";
            header("Location: addbook.php");
            exit();
        }

        if (!move_uploaded_file($photoTmpName, $photoPath)) {
            $_SESSION['message'] = "Failed to upload the image.";
            $_SESSION['message_type'] = "danger";
            header("Location: addbook.php");
            exit();
        }
    } else {
        $photoPath = "bookimages/defaultbook.jpg";
    }

    try {
        $query = "INSERT INTO books (title, description, photo, available_copies) VALUES (:title, :description, :photo, :available_copies)";
        
        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':photo', $photoPath);
        $stmt->bindParam(':available_copies', $available_copies, PDO::PARAM_INT);
        
        $stmt->execute();
    
        $_SESSION['message'] = "Book added successfully!";
        $_SESSION['message_type'] = "success";
    } catch (PDOException $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
        $_SESSION['message_type'] = "danger";
    }
    
    header("Location: addbook.php");
    exit();
}
?>
