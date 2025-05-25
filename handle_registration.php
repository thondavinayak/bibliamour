<?php
session_start(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim(htmlentities($_POST['name']));
    $email = trim(htmlentities($_POST['email']));
    $password = trim(htmlentities($_POST['password']));
    $photo = $_FILES['photo']['name']; 
    $fileTemp = $_FILES['photo']['tmp_name']; 
    $fileSize = $_FILES['photo']['size']; 
    $role = 1; 
    
    if (!preg_match("/^[a-zA-Z0-9._]+@(gmail\.com|yahoo\.com|outlook\.com)$/", $email)) {
        $_SESSION['message'] = "Veuillez entrer une adresse email valide (gmail, yahoo, outlook).";
        $_SESSION['message_type'] = "danger";
        header('Location: registration.php');
        exit();
    }

    require_once("conn.php");
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email OR name = :name");
    $stmt->execute(['email' => $email, 'name' => $name]);
    $existingUser = $stmt->fetch();
    if ($existingUser) {
        if ($existingUser['email'] == $email) {
            $_SESSION['message'] = "Cet email est déjà utilisé par un autre utilisateur.";
            $_SESSION['message_type'] = "danger";
        } elseif ($existingUser['name'] == $name) {
            $_SESSION['message'] = "Ce nom est déjà utilisé. Veuillez choisir un autre.";
            $_SESSION['message_type'] = "danger";
        }
        header('Location: registration.php');
        exit();
    }

    if (!empty($photo)) {
        $photoExtension = strtolower(pathinfo($photo, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; 
        
        // Check file size (max 400KB)
        if ($fileSize > 400 * 1024) { 
            $currentSizeKB = round($fileSize / 1024, 2); // Convert bytes to KB
            $_SESSION['message'] = "La taille de l'image est de {$currentSizeKB} KB. Veuillez télécharger une image inférieure à 200 KB.";
            $_SESSION['message_type'] = "danger";
            header('Location: registration.php');
            exit();
        }

        if (!in_array($photoExtension, $allowedExtensions)) {
            $_SESSION['message'] = "Seules les extensions jpg, jpeg, png, et gif sont autorisées.";
            $_SESSION['message_type'] = "danger";
            header('Location: registration.php');
            exit();
        }

        $photoName = strtolower(str_replace(' ', '_', $name)) . '.' . $photoExtension;
        $uploadDirectory = './userimages/' . $photoName;

        if (move_uploaded_file($fileTemp, $uploadDirectory)) {
            $password = md5($password);

            $req = "INSERT INTO users (name, email, pwd, photo, role) VALUES (?, ?, ?, ?, ?)";
            $ps = $pdo->prepare($req);
            $params = array($name, $email, $password, $photoName, $role);

            if ($ps->execute($params)) {
                $_SESSION['message'] = "Vous avez été inscrit avec succès. Veuillez vous connecter pour accéder aux livres.";
                $_SESSION['message_type'] = "success";
            } else {
                $_SESSION['message'] = "Désolé, nous ne pouvons pas enregistrer votre profil pour le moment. Veuillez contacter notre service client pour obtenir de l'aide.";
                $_SESSION['message_type'] = "danger";
            }
        } else {
            $_SESSION['message'] = "Erreur lors du téléchargement de votre photo. Essayez à nouveau.";
            $_SESSION['message_type'] = "danger";
        }
    } else {
        $_SESSION['message'] = "Veuillez télécharger une photo de profil.";
        $_SESSION['message_type'] = "danger";
    }

    header('Location: registration.php');
    exit();
}
?>
