<?php
require_once __DIR__ . '/inc/bootstrap.php';
requireAuth();
require_once __DIR__ . '/inc/header.php' ?>
    <h3 class="mt-4 mb-3">Home</h3>
    <hr/>
<?php echo displayErrors() ?>
<?php echo displaySuccess() ?>
<?php echo displayInfo() ?>

<?php require_once __DIR__ . '/inc/footer.php' ?>