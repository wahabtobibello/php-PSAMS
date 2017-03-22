<?php include_once __DIR__ . '/inc/header.php' ?>
    <h3 class="mt-4 mb-3">Edit Profile</h3>
    <hr/>
    <form action="" method="post">
        <div class="form-group row">
            <label for="firstName" class="col-md-2 offset-md-2 col-form-label">First Name:</label>
            <div class="col-6">
                <input class="form-control" type="text" id="firstName" name="firstName">
            </div>
        </div>
        <div class="form-group row">
            <label for="lastName" class="col-md-2 offset-md-2 col-form-label">Last Name:</label>
            <div class="col-6">
                <input class="form-control" type="text" id="lastName" name="lastName">
            </div>
        </div>
        <div class="form-group row">
            <label for="newPassword" class="col-md-2 offset-md-2 col-form-label">New Password:</label>
            <div class="col-6">
                <input class="form-control" type="password" id="newPassword" name="newPassword">
            </div>
        </div>
        <div class="form-group row">
            <label for="rNewPassword" class="col-md-2 offset-md-2 col-form-label">Re-enter Password:</label>
            <div class="col-6">
                <input class="form-control" type="password" id="rNewPassword">
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-md-8 col-md-2">
                <button type="submit" class="btn btn-primary btn-block">OK</button>
            </div>
        </div>
    </form>
<?php include_once __DIR__ . '/inc/footer.php' ?>