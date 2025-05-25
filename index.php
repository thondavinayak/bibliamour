<?php
    session_start();//for messages
    $title = "Bienvenue";
    include 'header.php';
    include 'menu.php';
?>

<div class="video-background">
<video autoplay muted loop id="backgroundVideo">
    <source src="videos/vid2.mp4" type="video/mp4">
    Your browser does not support HTML5 video.
</video>
</div>

<div class="content">

<div class="container">

<?php
    if(isset($_SESSION['message'])) {
       
 ?>   
 
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <?=$_SESSION['message']?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    
    <?php  
        unset($_SESSION['message']);
    }
    ?>
        <br>
        <div class="indexcontainer">
            <h1>Bienvenue à BibliAmour !</h1>
            <p>Bonjour! Nous sommes des étudiants à <strong>ESIGELEC Rouen</strong>. 
            Nous avons develop un site pour gérer une bibliothèque. Ce site s'appelle <strong>BibliAmour</strong>. 
            Pourquoi <strong>"Amour"</strong>? Parceque nous aimons les livres!</p>

            <p>Voici ce que vous pouvez faire sur notre site:</p>
            <ul>
                <li><strong>S'inscrire et se connecter</strong>: Vous pouvez créer un compte et vous connecter facilement.</li>
                <li><strong>Voir les livres</strong>: Vous pouvez voir les livres de la bibliothèque.</li>
                <li><strong>Emprunter des livres</strong>: Si vous êtes inscrit, vous pouvez emprunter des livres.</li>
                <li><strong>Gestion des livres</strong>: Les administrateurs peuvent ajouter ou enlever des livres.</li>
            </ul>

            <p>Nous avons fait ce projet pour notre cours <strong>"Web Centric Development"</strong>. C'est simple et amusant! Amusez-vous avec notre bibliothèque!</p>
            </div>
        </div>
    
    </div> 

<?php
    include 'footer.php';
?>