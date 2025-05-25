<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>


<nav class="navbar navbar-expand-md bg-dark border-body" data-bs-theme="dark">
  <div class="container-fluid">

    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) : ?>
      <?php if (isset($_SESSION['adminlogin']) && $_SESSION['adminlogin']) : ?>
        <a class="navbar-brand" href="#">
          <img src="./images/logo.png" alt="Logo" width="56" height="52" style="padding-top:6px;" class="d-inline-block align-text-top">
        </a>
      <?php else : ?>
        <a class="navbar-brand" href="#">
          <img src="./images/logo.png" alt="Logo" width="56" height="52" style="padding-top:6px;" class="d-inline-block align-text-top">
          BibliAmour
        </a>
      <?php endif; ?>
    <?php else : ?>
      <a class="navbar-brand" href="index.php">
        <img src="./images/logo.png" alt="Logo" width="56" height="52" style="padding-top:6px;" class="d-inline-block align-text-top">
          BibliAmour
      </a>
    <?php endif; ?>


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav"> 
      <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) : ?>
      
      
        <li class="nav-item">
          <a class="nav-link <?= $currentPage == 'userpage.php' ? 'active' : '' ?>" href="userpage.php">Bienvenue</a>
        </li>
         
        <?php if (isset($_SESSION['adminlogin']) && $_SESSION['adminlogin']) : ?>
          <li class="nav-item">
            <a class="nav-link <?= $currentPage == 'listusers.php' ? 'active' : '' ?>" href="listusers.php">Gérer Users</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?= $currentPage == 'listbooks.php' ? 'active' : '' ?>" href="listbooks.php">Gérer Livres</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?= $currentPage == 'addbook.php' ? 'active' : '' ?>" href="addbook.php">Ajouter un Livre</a>
          </li>
        <?php else : ?> 
          <li class="nav-item">
             <a class="nav-link <?= $currentPage == 'availablebooks.php' ? 'active' : '' ?>" href="availablebooks.php">Available Livres</a>
          </li>
        <?php endif; ?>
      </ul>

      <ul class="navbar-nav ms-auto mb-2 mb-md-0">        
        <li class="nav-item">
          <a class="nav-link <?= $currentPage == 'dashboard.php' ? 'active' : '' ?>" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $currentPage == 'profileinfo.php' ? 'active' : '' ?>" href="profileinfo.php">Votre Account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="logout.php">Deconnexion</a>
        </li>


      <?php else : ?>
        <li class="nav-item">
          <a class="nav-link <?= $currentPage == 'index.php' ? 'active' : '' ?>" href="index.php">Bienvenue</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $currentPage == 'bookcarousel.php' ? 'active' : '' ?>" href="bookcarousel.php">Nouvea Livres</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-md-0">

        <li class="nav-item">
          <a class="nav-link <?= $currentPage == 'registration.php' ? 'active' : '' ?>" href="registration.php">Inscription</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $currentPage == 'connection.php' ? 'active' : '' ?>" href="connection.php">Connexion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $currentPage == 'about.php' ? 'active' : '' ?>" href="about.php">Apropos</a>
        </li>
      <?php endif; ?>


        
        <li class="nav-item d-flex align-items-center">
          <div id="google_translate_element" style="width: 210px; height: 30px; background-color: #343a40; border-radius: 5px;"></div>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'fr', // Default page language
      includedLanguages: 'en,fr,hi,de', // Languages to include
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');
  }
</script>
<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
