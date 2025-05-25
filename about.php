<?php
session_start();
$title = "à propos";
include 'header.php';
include 'menu.php';
?>
<div class="container text-center mt-5">
    <h1 class="mb-4">A propos la Team</h1>
    <div class="row justify-content-center">
        <div class="col-md-4 mb-4">
            <div class="card team-card">
                <img src="images/koti1.jpg" class="card-img-top profile-photo" alt="Koteswara Rao Sangapu">
                <div class="card-body">
                    <h4 class="text-white">Koteswara Rao Sangapu</h4>
                    <a href="https://www.linkedin.com/in/koteswara-rao-sangapu" target="_blank" class="linkedin-icon">
                        <img src="images/linkedinlogo.png" alt="LinkedIn" style="width: 24px; height: auto;">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card team-card">
                <img src="images/vinayak1.jpg" class="card-img-top profile-photo" alt="Vinayak Thonda">
                <div class="card-body">
                    <h4 class="text-white">Vinayak Thonda</h4>
                    <a href="https://www.linkedin.com/in/vinayak-thonda" target="_blank" class="linkedin-icon">
                        <img src="images/linkedinlogo.png" alt="LinkedIn" style="width: 24px; height: auto;">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card team-card">
                <img src="userimages/default.jpg" class="card-img-top profile-photo" alt="Prof Ouchenne">
                <div class="card-body">
                    <h4 class="text-white">Prof Ouchenne</h4>
                    <a href="https://www.linkedin.com/in/prof-ouchenne" target="_blank" class="linkedin-icon">
                        <img src="images/linkedinlogo.png" alt="LinkedIn" style="width: 24px; height: auto;">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>
