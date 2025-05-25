<?php
    session_start();
    $title = "Logout";
    include 'header.php';
    //include 'menu.php';
    session_destroy(); 
?>
<div class="container text-center" style="font-family: 'Open Sans', sans-serif; margin-top: 50px;">
    <div style="color: #333333; margin-bottom: 20px;">
        <h1>Vous êtes déconnecté avec succès</h1>
        <p>Veuillez fermer cette page de navigateur pour des raisons de sécurité. Si vous souhaitez vous reconnecter, utilisez la page de connexion ci-dessous :        </p>
    </div>
    <a href="connection.php" style="text-decoration: none;">
        <button class="btn btn-primary">
            Aller à la page de connexion
        </button>
    </a>
</div>
<?php
    include 'footer.php';
?>

