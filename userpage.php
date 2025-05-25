<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    $_SESSION['message'] = "Please log in to access this page.";
    header('Location: connection.php');
    exit();
}

$title = "Welcome";
include 'header.php';
include 'menu.php';
?>

<div class="container mt-5">
    <h1>Bonjour, <?php echo htmlspecialchars($_SESSION['user']['name']); ?>&nbsp;!</h1>
    <p>Bienvenue sur votre account. N'hésitez pas à explorer votre compte et à gérer vos activités.</p>
</div>

<?php include 'footer.php'; ?>
