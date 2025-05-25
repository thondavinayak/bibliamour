<?php
include_once 'conn.php'; 

$query = "SELECT id, title, description, photo FROM books WHERE available_copies > 0 LIMIT 5";
$stmt = $pdo->prepare($query);
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = "Nouveau Livres";
include 'header.php';
include 'menu.php';
?>

<div class="container text-center mt-4">
    <!--h1 class="mb-4">Nouveaux Livres</h1-->
    <!-- Bootstrap Carousel -->
    <div id="bookCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000" style="width:100%; max-width:480px; margin: 0 auto;">
        
        <!-- Indicators -->
        <div class="carousel-indicators">
            <?php foreach ($books as $index => $book): ?>
                <button type="button" data-bs-target="#bookCarousel" data-bs-slide-to="<?php echo $index; ?>" 
                        class="<?php echo $index === 0 ? 'active' : ''; ?>" 
                        aria-current="<?php echo $index === 0 ? 'true' : 'false'; ?>" 
                        aria-label="Slide <?php echo $index + 1; ?>"></button>
            <?php endforeach; ?>
        </div>

        <!-- Carousel Items -->
        <div class="carousel-inner" style="background-color: #333333;">
            <?php if ($books): ?>
                <?php $active = 'active'; ?>
                <?php foreach ($books as $book): ?>
                    <div class="carousel-item <?php echo $active; ?>">
                        <img src="<?php echo file_exists( $book['photo']) 
                                    ? htmlspecialchars($book['photo']) 
                                    : 'bookimages/defaultbook.jpg'; ?>" 
                             class="d-block w-100" alt="Book Photo" style="height: 530px; object-fit: contain;">
                        <div class="carousel-caption d-none d-md-block">
                            <!--h4--><!--?php echo htmlspecialchars($book['title']); ?--><!--/h4-->
                            <a href="bookdetail.php?id=<?php echo $book['id']; ?>" style="color:white; text-decoration:none;">
                                <button class="btn btn-primary">
                                        Voir les Details
                                </button>
                            </a>
                        </div>
                    </div>
                    <?php $active = ''; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No books are available at the moment.</p>
            <?php endif; ?>
        </div>

        <!-- Navigation Buttons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#bookCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bookCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

    </div>
    <div style="padding-bottom:40px;"></div>
</div>

<?php 
session_destroy();
include 'footer.php'; 
?>
