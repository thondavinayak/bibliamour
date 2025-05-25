<?php
session_start();
require_once 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim(htmlentities($_POST['email']));
    $password = trim(htmlentities($_POST['password']));
    $hashedPassword = md5($password);

    $query = "SELECT * FROM users WHERE email = :email AND pwd = :pwd";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['email' => $email, 'pwd' => $hashedPassword]);
    $user = $stmt->fetch();

    if ($user) {
        //$_SESSION['user'] = $user; 
        $_SESSION['user'] = [
            'email' => $user['email'],
            'name' => $user['name'],
            'role' => $user['role'],
            'photo' => $user['photo'],
            'id' => $user['id'],
        ];
        $_SESSION['logged_in'] = true;
        
        $adminlogin = $user['role'] == 0;
        $_SESSION['adminlogin'] = $adminlogin;
        
        header('Location: userpage.php');
        exit();
    } else {
        $_SESSION['message'] = "Identifiant ou mot de passe invalide. Veuillez réessayer.";
        $_SESSION['message_type'] = "danger";
        header('Location: connection.php');
        exit();
    }
}
?>
