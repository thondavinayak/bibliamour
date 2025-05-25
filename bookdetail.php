<?php
include_once 'conn.php'; 

//var_dump($_GET['id']);
//exit();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid book ID.");
}

$book_id = htmlspecialchars($_GET['id']); 

$query = "SELECT * FROM books WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $book_id]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$book) {
    die("Livre Introuable");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
    $book_id = intval($_POST['book_id']);
    
    $user = $_SESSION['user']; 
    $user_id = $user['id'];

    $checkQuery = "SELECT available_copies FROM books WHERE id = :book_id AND available_copies > 0";
    $checkStmt = $pdo->prepare($checkQuery);
    $checkStmt->execute(['book_id' => $book_id]);
    $availableCopies = $checkStmt->fetchColumn();

    if ($availableCopies) {
        $insertQuery = "INSERT INTO borrowed_books (user_id, book_id) VALUES (:user_id, :book_id)";
        $insertStmt = $pdo->prepare($insertQuery);
        $insertStmt->execute([
            'user_id' => $user_id,
            'book_id' => $book_id
        ]);

        $updateQuery = "UPDATE books SET available_copies = available_copies - 1 WHERE id = :book_id";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->execute(['book_id' => $book_id]);

        $_SESSION['message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert" style="position: absolute; top: 0px; z-index: 10; width: 100%; height:70px; text-align: center;">
            Livre borrow avec success!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    } else {
        $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="position: absolute; top: 0px; z-index: 10; width: 100%; height:70px; text-align: center;">
            Livre indisponsible.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    //header("Location: " . $_SERVER['PHP_SELF']);
    header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . urlencode($book_id));
    exit();   
}



$title = "Livre Details: " . htmlspecialchars($book['title']);
include 'header.php';
include 'menu.php';
?>



<div class="container mt-5">

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

    <h1 style="padding-left:10px;">Livre Details</h1>
    <div class="book-info">
        <div class="row">
            <div class="col-md-4">
                <img src="<?php echo htmlspecialchars($book['photo']); ?>" 
                     alt="Book Photo" 
                     class="img-fluid" 
                     style="width: 300px; height: 400px;">
            </div>
            <div class="col-md-8" style="padding-left:20px; ">
                <ul class="list-unstyled">
                    <li><strong>Title:</strong> <?php echo htmlspecialchars($book['title']); ?></li>
                    <li><strong>Description:</strong> <?php echo htmlspecialchars($book['description']); ?></li>
                </ul>

                <?php if (isset($_SESSION['user']) && (!isset($_SESSION['adminlogin']) || $_SESSION['adminlogin'] != 1)) : ?>
                    <form method="POST">
                        <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book['id']); ?>">
                        <button class="btn btn-primary" type="submit" style="background-color: green; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                            Borrow Livre
                        </button>
                    </form>

                    <div style="padding-top:20px;"> </div>
                    <!--form method="POST"-->
                        <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book['id']); ?>">
                        <button class="btn btn-primary" style="background-color: green; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                            Retour Livre
                        </button>
                    <!--/form-->

                    <div style="padding-top:20px;"> </div>
                    <a href="availablebooks.php" style="text-decoration: none;">
                        <button class="btn btn-primary" type="button">Retour a Available Livres List</button>
                    </a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
