<?php
require_once __DIR__ . '/inc/bootstrap.php';
requireAuth();
require_once __DIR__ . '/inc/header.php' ?>
    <h3 class="mt-4 mb-3">Bookings</h3>
    <hr/>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Student Name</th>
            <th>Matric No.</th>
            <th>Day</th>
            <th>Time</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td scope="row">John Doe
            </td>
            <td>130805000</td>
            <td>Monday</td>
            <td>02:00pm</td>
            <td>
                <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#compose" data-type="compose">
                    Message
                </button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#compose" data-type="cancel">
                    Cancel
                </button>
            </td>
        </tr>
        <?php include_once __DIR__ . '/inc/composeMessageModal.php' ?>
        </tbody>
    </table>
<?php require_once __DIR__ . '/inc/footer.php' ?>