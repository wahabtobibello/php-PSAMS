<?php
require_once __DIR__ . '/inc/bootstrap.php';
requireStudent();
include_once __DIR__ . '/inc/header.php' ?>
    <h3 class="mt-4 mb-3">My Profile</h3>
    <hr/>
<?php echo displayErrors();
echo displaySuccess();
echo displayInfo();
if(empty($user['profile_picture'])){
    $picture = 'http://placehold.it/320x320';
}else{
    $picture = $user['profile_picture'];
}
?>
    <div class="media offset-md-2 mt-4">
        <img class="d-flex mr-3" src="<?php echo $picture?>" style="background-size: cover;" alt="image"
             width="320" height="320"/>
        <div class="media-body">
            <h2 class="mt-0 mb-3">Basic Info</h2>
            <p class="lead"><strong>Full name:</strong> <?php echo $user['first_name'] . " " . $user['last_name']; ?>
            </p>
            <p class="lead"><strong>Matric Number:</strong> <?php echo $user['user_number'] ?></p>
            <p class="lead"><strong>Project Topic:</strong> <?php echo $user['project'] ?></p>
            <a href="/editProfile.php" class="btn btn-primary mt-3">Edit Profile</a>
        </div>
    </div>
<?php include_once __DIR__ . '/inc/footer.php' ?>