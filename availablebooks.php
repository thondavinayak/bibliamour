<?php
include_once 'conn.php'; 
include_once 'roleuser.php';

$query = "SELECT * FROM books WHERE available_copies > 0";
$stmt = $pdo->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

        $_SESSION['message'] = 'Livre borrow avec success!';
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = 'Livre indisponsible.';
        $_SESSION['message_type'] = "danger";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();   
}

$title = "Available Books";
include 'header.php';
include 'menu.php';
?>


<div class="mx-3 my-3">

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

    <h1>Available Livres</h1>
    <table class="custom-table">
        <thead>
            <tr style="background-color: black; color: white; border: 1px solid #333333;">
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $book): ?>
                <tr style="background-color: #f0f0f0; border: 1px solid #555555;">
                    <td><?php echo htmlspecialchars($book['id']); ?></td>

                    <td>
                        <a href="bookdetail.php?id=<?php echo htmlspecialchars($book['id']); ?>" style="text-decoration: none; color: blue;">
                            <?php echo htmlspecialchars($book['title']); ?>
                        </a>
                    </td>
                    <!--td--><!--?php echo htmlspecialchars($book['title']); ?--><!--/td-->
                    <td><?php echo htmlspecialchars($book['description']); ?></td>
                    

                    <td>
                        <img src="<?php echo htmlspecialchars($book['photo']); ?>" 
                            alt="Book Photo" 
                            style="width: 120px; height: 120px; cursor: pointer;" 
                            data-toggle="modal" 
                            data-target="#imageModal<?php echo $book['id']; ?>">
                        <div class="modal fade" id="imageModal<?php echo $book['id']; ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo $book['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel<?php echo $book['id']; ?>"><?php echo htmlspecialchars($book['title']); ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="<?php echo htmlspecialchars($book['photo']); ?>" alt="Zoomed Book Photo" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>


                    <!--td>
                        <img src="<?php echo htmlspecialchars($book['photo']); ?>" 
                             alt="Book Photo" 
                             style="width: 50px; height: 50px;">
                    </td-->
                    <td>
                        <form method="POST">
                            <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book['id']); ?>">
                            <button class="btn btn-primary" type="submit" style="background-color: green; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                                Borrow Livre
                            </button>
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
