<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$title = "Connection";
include 'header.php';
include 'menu.php';
?>
<div class="container">
    <?php
        if (isset($_SESSION['message'])) {
            $messageType = $_SESSION['message_type'] ? $_SESSION['message_type'] : 'success';

            if ($messageType === 'danger') {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
            } elseif ($messageType === 'success') {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
            }
            echo htmlspecialchars($_SESSION['message']);
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';

            unset($_SESSION['message']);
            unset($_SESSION['message_type']); 
        }
    ?>


<div class="mt-3">
    <h1>Connecxion</h1>
    <p>Content de te revoir! Veuillez vous connecter pour accéder à votre compte.</p>

    <form method="POST" action="handle_login.php" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email" required>
            <div class="invalid-feedback">Veuillez fournir une adresse e-mail valide.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre password" required>
            <div class="invalid-feedback">Veuillez fournir une password valide.</div>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<script>
(() => {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();
</script>

</div>
<?php
include 'footer.php';
?>