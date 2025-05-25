<?php
include_once 'conn.php'; 
include_once 'roleadmin.php';

$query = "SELECT * FROM users";
$stmt = $pdo->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['make_admin'])) {
        $userId = intval($_POST['user_id']);
        $updateQuery = "UPDATE users SET role = 0 WHERE id = :id";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $updateStmt->execute();
        header("Location: listusers.php");
        exit();
    }

    if (isset($_POST['remove_user'])) {
        $userId = intval($_POST['user_id']);
        $deleteQuery = "DELETE FROM users WHERE id = :id";
        $deleteStmt = $pdo->prepare($deleteQuery);
        $deleteStmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $deleteStmt->execute();
        header("Location: listusers.php");
        exit();
    }
}

$title = "Liste d'utilisateurs";
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
            unset($_SESSION['message_type']);
        }
    ?>

    <div class="my-3 mx-3">
        <h1>Liste d'users</h1>
        <table class="custom-table">
            <thead>
                <tr style="background-color: black; color: white;">
                    <th>ID</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Photo</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $user): ?>
                <tr style="background-color: #f0f0f0;">
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td>
                        <img src="userimages/<?php echo file_exists('./userimages/' . $user['photo']) && !empty($user['photo']) ? htmlspecialchars($user['photo']) : 'default.jpg'; ?>" 
                             alt="Photo" 
                             style="width: 50px; height: 50px; border-radius: 50%; cursor: pointer;"
                             data-toggle="modal" 
                             data-target="#imageModal<?php echo $user['id']; ?>">
                        <div class="modal fade" id="imageModal<?php echo $user['id']; ?>" tabindex="-1" aria-hidden="true">
                        <!--div class="modal fade" id="imageModal<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="modalLabel--><!--?php echo $user['id']; ?>" aria-hidden="true"-->    
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="<?php echo htmlspecialchars('./userimages/' . $user['photo']); ?>" alt="Zoomed User Photo" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>     

                    </td>
                    <td><?php echo $user['role'] == 0 ? 'Admin' : 'User'; ?></td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                            <?php if ($user['role'] == 1): ?>
                                <button class="btn btn-primary" type="submit" onClick="return confirm('Are you sure ? ')" name="make_admin" style="background-color: green; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                                    Make Admin
                                </button>
                            <?php endif; ?>
                            <button  class="btn btn-primary"  type="submit" onClick="return confirm('Are you sure ? ')" name="remove_user" style="background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                                Remove User
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include 'footer.php'; ?>