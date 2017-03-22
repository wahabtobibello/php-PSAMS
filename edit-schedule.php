<?php require_once __DIR__ . '/inc/header.php' ?>
    <h3 class="mt-4 mb-3">Schedule</h3>
    <hr/>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Day</th>
            <th>From</th>
            <th>To</th>
            <th>Max. number of appointments</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">Monday</th>
            <form action="post">
                <td><input class="form-control" type="time" name="usr_time" value="08:00"></td>
                <td><input class="form-control" type="time" name="usr_time" value="13:00"></td>
                <td><input class="form-control" type="number" name="points" min="0" value="5"></td>
                <td>
                    <button type="button" class="btn btn-primary">Save</button>
                </td>
            </form>
        </tr>
        </tbody>
    </table>
<?php require_once __DIR__ . '/inc/footer.php' ?>