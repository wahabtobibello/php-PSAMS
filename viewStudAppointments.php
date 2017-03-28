<?php
require_once __DIR__ . '/inc/bootstrap.php';
requireStudent();
require_once __DIR__ . '/inc/header.php' ?>
    <h3 class="mt-4 mb-3">Bookings</h3>
    <hr/>
<?php echo displayErrors();
echo displaySuccess();
echo displayInfo(); ?>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Day</th>
            <th>Time</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach (getMyAppointments($user['user_number']) as $item) {
            $time = $item['appointment_time'];
            $day = $item['day'];
            echo "<tr>";
            echo "<td>" . $day . "</td>";
            echo "<td>" . $time . "</td>";
            echo "
            <td>
                <a class='btn btn-danger' href='/procedures/doCancelAppointment.php?appId=" . $item['appointment_id']
                . "&time=" . $item['appointment_time'] . "' data-type = 'cancel'
                 data-time='" . $time . "'>
        Cancel
                </a>
            </td>";
            echo "</tr>";
        }; ?>
        </tbody>
    </table>

<?php
require __DIR__ . '/inc/composeMessageModal.php';
require __DIR__ . '/inc/footer.php';
?>