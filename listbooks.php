<?php
include_once 'conn.php'; 
include_once 'roleadmin.php';

$query = "SELECT * FROM books";
$stmt = $pdo->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookId = intval($_POST['book_id']);
    
    if (isset($_POST['remove_book'])) {
        $deleteQuery = "DELETE FROM books WHERE id = :id";
        $deleteStmt = $pdo->prepare($deleteQuery);
        $deleteStmt->bindParam(':id', $bookId, PDO::PARAM_INT);
        $deleteStmt->execute();
        header("Location: listbooks.php");
        exit();
    }

    if (isset($_POST['update_quantity'])) {
        $newQuantity = intval($_POST['available_copies']);
        $updateQuery = "UPDATE books SET available_copies = :available_copies WHERE id = :id";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->bindParam(':available_copies', $newQuantity, PDO::PARAM_INT);
        $updateStmt->bindParam(':id', $bookId, PDO::PARAM_INT);
        $updateStmt->execute();
        header("Location: listbooks.php");
        exit();
    }

    if (isset($_POST['update_title'])) {
        $newTitle = $_POST['title'];
        $updateQuery = "UPDATE books SET title = :title WHERE id = :id";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->bindParam(':title', $newTitle);
        $updateStmt->bindParam(':id', $bookId, PDO::PARAM_INT);
        $updateStmt->execute();
        header("Location: listbooks.php");
        exit();
    }

    if (isset($_POST['update_description'])) {
        $newDescription = $_POST['description'];
        $updateQuery = "UPDATE books SET description = :description WHERE id = :id";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->bindParam(':description', $newDescription);
        $updateStmt->bindParam(':id', $bookId, PDO::PARAM_INT);
        $updateStmt->execute();
        header("Location: listbooks.php");
        exit();
    }

    if (isset($_POST['update_photo'])) {
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $photo = $_FILES['photo'];
            $photoName = time() . "_" . basename($photo['name']);
            $photoTmpName = $photo['tmp_name'];
            $photoPath = "bookimages/" . $photoName;

            if (move_uploaded_file($photoTmpName, $photoPath)) {
                $updateQuery = "UPDATE books SET photo = :photo WHERE id = :id";
                $updateStmt = $pdo->prepare($updateQuery);
                $updateStmt->bindParam(':photo', $photoPath);
                $updateStmt->bindParam(':id', $bookId, PDO::PARAM_INT);
                $updateStmt->execute();
            }
        }
        header("Location: listbooks.php");
        exit();
    }
}

$title = "List de Livres";
include 'header.php';
include 'menu.php';
?>

<div class="my-3 mx-3">

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

    <h1>List de Livres</h1>
    <table class="custom-table">
        <thead>
            <tr style="background-color: black; color: white; border: 1px solid #333333;">
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Photo</th>
                <th style="text-align:center;">Copies Disponsible</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $book): ?>
                <tr style="background-color: #f0f0f0; border: 1px solid #555555;">
                    <td><?php echo htmlspecialchars($book['id']); ?></td>
                    <td><?php echo htmlspecialchars($book['title']); ?></td>
                    <td><?php echo htmlspecialchars($book['description']); ?></td>
                    <td>
                        <img src="<?php echo htmlspecialchars($book['photo']); ?>" 
                             alt="Book Photo" 
                             style="width: 50px; height: 50px; cursor: pointer; padding-left:2px;"
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
                    <td style="text-align:center;"><?php echo htmlspecialchars($book['available_copies']); ?></td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book['id']); ?>">
                            <button  class="btn btn-primary" type="submit" onClick="return confirm('Are you sure ? ')" name="remove_book" style="background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                                Remove Book
                            </button>
                        </form>

                        <br>
                        <div style="padding-top: 8px;"></div>

                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book['id']); ?>">
                            <button type="submit" name="update_quantity" style="background-color: blue; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                                Update Quantity
                            </button>
                            <input type="number" name="available_copies" value="<?php echo htmlspecialchars($book['available_copies']); ?>" min="0" style="width: 60px;">
                        </form>

                        <br>
                        <div style="padding-top: 8px;"></div>

                        <form method="POST">
                            <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book['id']); ?>">
                            <button type="submit" name="update_title" style="background-color: green; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                                Update Title
                            </button>
                            <input type="text" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" placeholder="Title">  
                        </form>
                        <div style="padding-top: 8px;"></div>
                        <form method="POST">
                            <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book['id']); ?>">
                             <button type="submit" name="update_description" style="background-color: orange; color: white; border: none; padding: 5px 10px; padding-left:200px; cursor: pointer;">
                                Update Description
                            </button>
                            <input type="text"  name="description" value="<?php echo htmlspecialchars($book['description']); ?>" placeholder="Description">
                        </form>
                        <div style="padding-top: 8px;"></div>
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book['id']); ?>">
                            <button type="submit" name="update_photo" style="background-color: purple; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                                Update Photo
                            </button>
                            <input type="file" name="photo">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
