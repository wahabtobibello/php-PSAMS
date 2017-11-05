<?php
	require_once __DIR__ . '/inc/bootstrap.php';
	requireSupervisor();
	require_once __DIR__ . '/inc/header.php'
?>
<h3 class="mt-4 mb-3">All Students</h3>
<hr/>
<?php
	foreach (getAllStudents() as $student) {
		if (empty($student['profile_picture'])) {
			$picture = 'http://placehold.it/120x120';
		} else {
			$picture = "img/uploads/" . $student['matric_number'] . "." . pathinfo($student['profile_picture'], PATHINFO_EXTENSION)."?1";
		}
		$matricNo = $student['user_number'];
?>
<div class="media mb-3">
	<div class="d-flex mr-3" style="width:120px; height:120px; background-size:cover;
			background-image:url('<?php echo $picture?>');">
		<!--            <img  src="--><?php //echo $picture ?><!--" style="background-size: cover;" alt="image"/>-->
	</div>
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