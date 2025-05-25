<?php
include_once 'conn.php';

$user = $_SESSION['user'];
$title = "Dashboard - Borrowed Livres";
include 'header.php';
include 'menu.php';
?>

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

    if (isset($_SESSION['adminlogin']) && $_SESSION['adminlogin']):
        $query = "
            SELECT u.id AS user_id, u.name AS user_name, 
            GROUP_CONCAT(CONCAT(b.id, ' - ', b.title) SEPARATOR '<br>') AS borrowed_books
            FROM users u
            LEFT JOIN borrowed_books bb ON u.id = bb.user_id
            LEFT JOIN books b ON bb.book_id = b.id
            WHERE bb.book_id IS NOT NULL
            GROUP BY u.id, u.name
            ORDER BY u.id
        ";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $user_books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

    <div class="container" style="padding-top:10px;">
        <div class="row mt-4">
            <div class="col-md-6">
                <h1>Borrowed Livres</h1>            
                <?php if (count($user_books) > 0): ?>
                    <table class="custom-table">
                        <thead>
                            <tr style="background-color: black; color: white; border: 1px solid #333333;">
                                <th>ID</th>
                                <th>User</th>
                                <th>Livre Id & Borrowed Livre[s]</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user_books as $row): ?>
                                <tr style="background-color: #f0f0f0; border: 1px solid #555555;">
                                    <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                                    <td><?php echo $row['borrowed_books'] ?: 'No Livre borrowed'; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No users borrowed Livres.</p>
                <?php endif; ?>
            </div>

            <div class="col-md-1"></div>

            <div class="col-md-5">
                <h1>Statistics</h1>
                <?php
                $total_users = $pdo->query("SELECT COUNT(*) AS total_users FROM users")->fetch(PDO::FETCH_ASSOC)['total_users'];
                $total_books = $pdo->query("SELECT COUNT(*) AS total_books FROM books")->fetch(PDO::FETCH_ASSOC)['total_books'];
                $low_copies_books = $pdo->query("SELECT title FROM books WHERE available_copies > 0 AND available_copies < 2")->fetchAll(PDO::FETCH_ASSOC);
                $no_copies_books = $pdo->query("SELECT title FROM books WHERE available_copies = 0")->fetchAll(PDO::FETCH_ASSOC);
                $most_borrowed = $pdo->query("
                    SELECT u.name AS user_name, COUNT(bb.book_id) AS borrow_count 
                    FROM borrowed_books bb 
                    JOIN users u ON bb.user_id = u.id 
                    GROUP BY bb.user_id 
                    ORDER BY borrow_count DESC 
                    LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                ?>

                <p><strong>Total Users:</strong> <?php echo $total_users; ?></p>
                <p><strong>Total Books:</strong> <?php echo $total_books; ?></p>

                <p><strong>Books with Less Than 2 Copies:</strong></p>
                <ul>
                    <?php if ($low_copies_books): ?>
                        <?php foreach ($low_copies_books as $book): ?>
                            <li><?php echo htmlspecialchars($book['title']); ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No such books.</li>
                    <?php endif; ?>
                </ul>

                <p><strong>Books with Zero Copies Available:</strong></p>
                <ul>
                    <?php if ($no_copies_books): ?>
                        <?php foreach ($no_copies_books as $book): ?>
                            <li><?php echo htmlspecialchars($book['title']); ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No books are out of stock.</li>
                    <?php endif; ?>
                </ul>

                            
                <p><strong>User Who Borrowed the Most Books:</strong> 
                    <?php echo $most_borrowed ? htmlspecialchars($most_borrowed['user_name']) . ' - ' . htmlspecialchars($most_borrowed['borrow_count']) . '' : 'No data available'; ?>
                </p>

            </div>
        </div>
        <div style="padding-bottom:60px;"> </div>
    </div>

<?php 
    else:
        $user_id = $user['id'];
        $stmt = $pdo->prepare("
            SELECT b.id AS book_id, b.title 
            FROM borrowed_books bb
            JOIN books b ON bb.book_id = b.id
            WHERE bb.user_id = :user_id
        ");
        $stmt->execute(['user_id' => $user_id]);
        $borrowed_books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="container" style="padding-top:30px;">
        <h1>Votre Borrowed Livres</h1>
        <div class="row">
            <div class="col-md-12">
                <?php if (count($borrowed_books) > 0): ?>
                    <table class="custom-table">
                        <thead class="bg-dark text-white">
                            <tr style="background-color: black; color: white; border: 1px solid #333333;">
                                <th>Livre ID</th>
                                <th>Livre Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($borrowed_books as $book): ?>
                                <tr  style="background-color: #f0f0f0; border: 1px solid #555555;">
                                    <td><?php echo htmlspecialchars($book['book_id']); ?></td>
                                    <td><?php echo htmlspecialchars($book['title']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>You have not borrowed any Livres. Please borrow one.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php include 'footer.php'; ?>
