<?php
require_once __DIR__ . '/inc/bootstrap.php';
requireAuth();
include_once __DIR__ . '/inc/header.php' ?>
    <h3 class="mt-4 mb-3">My Profile</h3>
    <hr/>
    <div class="media offset-md-2 mt-4">
        <img class="d-flex mr-3" src="img/1451907072413.jpg" alt="image" width="320" height="320"/>
        <div class="media-body">
            <h4 class="mt-0 mb-3">Basic Info</h4>
            <p class="lead"><strong>Full name:</strong> _Full Name_</p>
            <p class="lead"><strong>Matric Number:</strong> _Matriculation Number_</p>
            <p class="lead"><strong>Project Topic:</strong> _Project Topic_</p>
        </div>
    </div>
<?php include_once __DIR__ . '/inc/footer.php' ?>