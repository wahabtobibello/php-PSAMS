<?php
	require_once __DIR__ . '/inc/bootstrap.php';
	require_once __DIR__ . '/inc/header.php';
	requireStudent(); 
?>
<h3 class="mt-4 mb-3">Edit Profile</h3>
<hr/>
<form method="post" action="procedures/doEditProfile.php?matric=<?php echo $user['user_number']?>" enctype="multipart/form-data">
	<?php echo displayErrors();
	echo displaySuccess();
	echo displayInfo(); ?>
	<div class="form-group row offset-2">
		<label for="picture" class="col-2 col-form-label">Upload Profile Picture</label>
		<div class="col-6 pt-3">
			<input type="file" class="form-control-file" id="picture" name="picture" aria-describedby="fileHelp">
		</div>
	</div>
	<div class="form-group row offset-2">
		<label for="firstName" class="col-2 col-form-label">First Name</label>
		<div class="col-6">
			<input class="form-control" type="text" id="firstName" name="firstName" value="<?php echo $user['first_name'] ?>" required>
		</div>
	</div>
	<div class="form-group row offset-2">
		<label for="lastName" class="col-2 col-form-label">Last Name</label>
		<div class="col-6">
			<input class="form-control" type="text" id="lastName" name="lastName" value="<?php echo $user['last_name'] ?>" required>
		</div>
	</div>
	<div class="form-group row offset-2">
		<label for="project" class="col-2 col-form-label">Project Topic</label>
		<div class="col-6">
			<input class="form-control" type="text" id="project" name="project" value="<?php echo $user['project'] ?>" required>
		</div>
	</div>
	<div class="form-group row">
		<div class="offset-sm-5 col-sm-10">
			<button type="submit" class="btn btn-primary">Edit</button>
		</div>
	</div>
</form>
<?php require_once __DIR__ . '/inc/footer.php' ?>
