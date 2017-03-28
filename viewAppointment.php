<?php
require_once __DIR__ . '/inc/bootstrap.php';
requireSupervisor();
require_once __DIR__ . '/inc/header.php' ?>
<h3 class="mt-4 mb-3">Bookings</h3>
<hr/>
<?php echo displayErrors();
echo displaySuccess();
echo displayInfo(); ?>
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
    <?php foreach (getAppointments($user['user_number']) as $item) {
        $time = $item['appointment_time'];
        $day = $item['day'];
        $fullName = $item['full_name'];
        $matricNo = $item['matric_number'];
        echo "<tr>";
        echo "<th scope='row'>" . $fullName . "</th>";
        echo "<td>" . $matricNo . "</td>";
        echo "<td>" . $day . "</td>";
        echo "<td>" . $time . "</td>";
        echo "
            <td>
                <button type ='button' class='btn btn-outline-info' data-toggle = 'modal' data-target = '#compose' data-type = 'compose' 
                data-recipient='" . $matricNo . "'>
        Message
                </button >
                <button type='button' class='btn btn-danger' data-toggle = 'modal' data-target = '#compose' data-type = 'cancel'
                data-recipient='" . $matricNo . "' data-time='" . $time . "'>
        Cancel
                </button >
            </td>";
        echo "</tr>";
    }; ?>
    </tbody>
</table>

<?php
require __DIR__ . '/inc/composeMessageModal.php';
require __DIR__ . '/inc/footer.php';
?>