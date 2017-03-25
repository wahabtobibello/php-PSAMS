<?php
require_once __DIR__ . '/inc/header.php';
requireNotAuth();?>
<h3 class="mt-4 mb-3">Log In</h3>
<hr/>
<form action="/procedures/doLogin.php" method="post">
    <?php echo displayErrors();?>
    <div class="form-group row offset-2">
        <label for="matricNo" class="col-2 col-form-label">Matric No.</label>
        <div class="col-6">
            <input class="form-control" type="number" min="0" id="matricNo" name="matricNo">
        </div>
    </div>
    <div class="form-group row offset-2">
        <label for="password" class="col-2 col-form-label">Password</label>
        <div class="col-6">
            <input class="form-control mb-3" type="password" id="password" name="password">
            Log in as <a href="/logInAdmin.php">supervisor</a>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-sm-5 col-sm-10">
            <button type="submit" class="btn btn-primary">Log in</button>
        </div>
    </div>
</form>
<?php require_once __DIR__ . '/inc/footer.php' ?>
