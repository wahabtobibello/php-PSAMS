<?php require_once __DIR__ . '/inc/header.php' ?>
<h3 class="mt-4 mb-3">Log In As Admin</h3>
<hr/>

<form action="/procedures/doAdminLogIn.php" method="post">
    <?php echo displayErrors();?>
    <div class="form-group row offset-2">
        <label for="password" class="col-2 col-form-label ">Enter Password</label>
        <div class="col-6">
            <input class="form-control" type="password" id="password" name="password">
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-sm-5 col-sm-10">
            <button type="submit" class="btn btn-primary">Log in</button>
        </div>
    </div>
</form>

<?php require_once __DIR__ . '/inc/footer.php' ?>
