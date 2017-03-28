<?php
require_once __DIR__ . '/inc/bootstrap.php';
requireSupervisor();
require_once __DIR__ . '/inc/header.php' ?>
    <h3 class="mt-4 mb-3">All Students</h3>
    <hr/>
<?php
foreach (getAllStudents() as $student) {
    if (empty($student['profile_picture'])) {
        $picture = 'http://placehold.it/320x320';
    } else {
        $picture = $student['profile_picture'];
    }
    $matricNo = $student['user_number'];
    ?>
    <div class="media mb-3">
        <img class="d-flex mr-3" src="<?php echo $picture ?>" alt="Generic placeholder image" width="120" height="120">
        <div class="media-body">
            <small class="text-muted">Full name: <?php echo $student['first_name'] . " " . $student['last_name']; ?>
            </small>
            <br/>
            <small class="text-muted">Matric Number: <?php echo $student['user_number'] ?></small>
            <br/>
            <small class="text-muted">Project Topic: <?php echo $student['project'] ?></small>
            <br/>
            <a href="/viewProfile.php?matric=<?php echo $matricNo;?>" class="btn btn-primary btn-sm mt-3">View Profile</a>
        </div>
    </div>
<?php } ?>
<?php require_once __DIR__ . '/inc/footer.php' ?>