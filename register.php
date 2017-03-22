<?php require_once __DIR__ . '/inc/header.php' ?>
<h3 class="mt-4 mb-3">Register</h3>
<hr/>
<form action="/procedures/doRegister.php" method="post">
    <div class="form-group row offset-2">
        <label for="firstName" class="col-2 col-form-label">First Name</label>
        <div class="col-6">
            <input class="form-control" type="text" id="firstName" name="firstName">
        </div>
    </div>
    <div class="form-group row offset-2">
        <label for="lastName" class="col-2 col-form-label">Last Name</label>
        <div class="col-6">
            <input class="form-control" type="text" id="lastName" name="lastName">
        </div>
    </div>
    <div class="form-group row offset-2">
        <label for="matricNo" class="col-2 col-form-label">Matric No.</label>
        <div class="col-6">
            <input class="form-control" type="number" min="0" id="matricNo" name="matricNo">
        </div>
    </div>
    <div class="form-group row offset-2">
        <label for="project" class="col-2 col-form-label">Project Topic</label>
        <div class="col-6">
            <input class="form-control" type="text" id="project" name="project">
        </div>
    </div>
    <div class="form-group row offset-2">
        <label for="password" class="col-2 col-form-label">Password</label>
        <div class="col-6">
            <input class="form-control" type="password"  id="password" name="password">
        </div>
    </div>
    <div class="form-group row offset-2">
        <label for="confirmPassword" class="col-2 col-form-label">Password</label>
        <div class="col-6">
            <input class="form-control" type="password" id="confirmPassword" name="confirmPassword">
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-sm-5 col-sm-10">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </div>
</form>
<?php require_once __DIR__ . '/inc/footer.php' ?>
