<?php require_once __DIR__ . '/inc/bootstrap.php' ?>
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
        <?php foreach (getDailySchedule() as $item) {
            $id = $item['day_id'];
            $day = $item['day'];
            $from = $item['from_time'];
            $to = $item['to_time'];
            $max = $item['appointment_max'];
            echo "<tr>";
            echo "<th scope=\"row\">" . $day . "</th>";
            echo "<td>" . $from . "</td>";
            echo "<td>" . $to . "</td>";
            echo "<td>" . $max . "</td>";
            echo "
            <td>
                <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editSchedule'
                data-day='" . $day . "' data-id='" . $id . "' data-from='" . $from
                . "' data-to='" . $to . "' data-max=" . $max . ">Edit</button>
                <form class='form-inline' method='post' action='procedures/doClearSchedule.php?id=" . $id . "'>
                <button type='submit' class='btn btn-secondary'>
                  Clear
                </button>
                </form>
            </td>";
            echo "</tr>";
        } ?>
        </tbody>
    </table>
<?php
require_once __DIR__ . '/inc/editScheduleModal.php';
require_once __DIR__ . '/inc/footer.php'
?>