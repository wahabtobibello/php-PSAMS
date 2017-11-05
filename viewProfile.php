<?php
	require_once __DIR__ . '/inc/bootstrap.php';
	requireAuth();
	include_once __DIR__ . '/inc/header.php'
?>
<h3 class="mt-4 mb-3">My Profile</h3>
<hr/>
<?php 
	echo displayErrors();
	echo displaySuccess();
	echo displayInfo();
	if (isSupervisor()) {
		$user = findUser(request()->get('matric'));
	}
	if (empty($user['profile_picture'])) {
		$picture = 'http://placehold.it/320x320';
	} else {
		$picture = "img/uploads/" . $user['matric_number'] . "." . pathinfo($user['profile_picture'], PATHINFO_EXTENSION);
	}
?>
<div class="media offset-md-2 mt-4">
	<div class="d-flex mr-3" style="width:320px; height:320px; background-size:cover;
			background-image:url('<?php echo $picture?>');">
		<!--            <img  src="--><?php //echo $picture ?><!--" style="background-size: cover;" alt="image"/>-->
	</div>
	<div class="media-body">
		<h2 class="mt-0 mb-3">Basic Info</h2>
		<p class="lead"><strong>Full name:</strong> <?php echo $user['first_name'] . " " . $user['last_name']; ?>
		</p>
		<p class="lead"><strong>Matric Number:</strong> <?php echo $user['user_number'] ?></p>
		<p class="lead"><strong>Project Topic:</strong> <?php echo $user['project'] ?></p>
		<?php if (!isSupervisor()): ?>
			<a href="/editProfile.php" class="btn btn-primary mt-3">Edit Profile</a>
			`<?php endif; ?>
	</div>
</div>
<?php include_once __DIR__ . '/inc/footer.php' ?>