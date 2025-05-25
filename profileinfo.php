<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: connection.php");
    $_SESSION["message"] = "Please Login to an Account";
    $_SESSION["message_type"] = "danger";
    exit();
}
$user = $_SESSION['user']; 
if (!$user) {
    header("Location: connection.php");
    exit();
}
$title = "Profile Info";
include 'header.php';
include 'menu.php';
?>


<div class="container mt-5">
    <h1>Votre Account</h1>
    <div class="profile-info">
        <div class="row">
            <div class="col-md-4">
                <!--img src="userimages/<?php echo !empty($user['photo']) ? htmlspecialchars($user['photo']) : 'default.jpg'; ?>" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 200px; height: 200px;"-->
                <img src="<?php echo file_exists('./userimages/' . $user['photo']) && !empty($user['photo']) ? 'userimages/' . htmlspecialchars($user['photo']) : 'userimages/default.jpg'; ?>" 
                    alt="Profile Picture" 
                    class="img-fluid rounded-circle" 
                    style="width: 200px; height: 200px;">

            </div>
            <div class="col-md-8">
                <ul class="list-unstyled">
                    <li><strong>Email:</strong> <?php echo $user['email']; ?></li>
                    <li><strong>Username:</strong> <?php echo $user['name']; ?></li>
                    <li><strong>Admin Access : </strong> <?php echo $user['role']; ?></li>

                    <li><strong>Profile :</strong> 
                        <?php 
                        echo $user['role'] == 1 ? 'User' : 'Admin'; 
                        ?>
                    </li>

                    <li><strong>User Id:</strong> <?php echo $user['id']; ?></li>

                </ul>
                <a href="#" style="text-decoration: none;">
                    <button class="btn btn-primary" href="#">Edit Profile</button>
                </a>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
