<?php
    include_once 'conn.php'; 
    include_once 'roleadmin.php';
    $title = "Add Book";
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
            unset($_SESSION['message_type']); // Clear message type
        }
    ?>

    <br>
    <h1>Ajouter un Livre</h1>
    <form method="POST" action="handle_addbook.php" enctype="multipart/form-data">
        <div class="container">
            <div class="row my-3">
                <div class="col-md-6">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Entrez le titre du livre" required>
                </div>
                <div class="col-md-6">
                    <label for="photo" class="form-label">Photo
                        <i style="font-size: 16px;"> (La taille de la photo doit être inférieure à 400 KB et .jpeg, jpg, png, gif) </i> 
                    </label>
                    <input type="file" class="form-control" id="photo" name="photo" required>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-md-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Entrez la description du livre" required></textarea>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-md-6">
                    <label for="available_copies" class="form-label">Copies Disponibles</label>
                    <input type="number" class="form-control" id="available_copies" name="available_copies" placeholder="Entrez le nombre de copies disponibles" required min="1">
                </div>
            </div>

            <div class="row my-3">
                <div class="d-grid gap-2 d-md-block">
                    <button class="btn btn-primary" type="submit">Ajouter le Livre</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
    include 'footer.php';
?>
