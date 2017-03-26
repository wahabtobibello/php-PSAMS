<?php
require_once __DIR__ . '/inc/bootstrap.php';
requireAuth();
require_once __DIR__ . '/inc/header.php' ?>
    <h3 class="mt-4 mb-3">Home</h3>
    <hr/>
<?php echo displayErrors();
echo displaySuccess();
echo displayInfo();
if (isSupervisor()) {
    redirect("/viewSchedule.php");
} else {
    $supervisor = findUser($user['staff_number']);
    echo "<h5 class='mb-3'>" . $supervisor['title'] . " " . $supervisor['first_name'] . " "
        . $supervisor['last_name'] . "'s schedule </h5>";
    echo "<table class='table table-striped table-hover' >
        <thead >
        <tr >
            <th > Day</th >
            <th > From</th >
            <th > To</th >
            <th > Max . number of appointments </th >
        </tr >
        </thead >
        <tbody >";
    foreach (getDailySchedule($supervisor['staff_number']) as $item) {
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
                <a href='/bookAppointment.php?id=" . $id . "&day=" . $day . "&endDate=" . $supervisor['end_date'] .
            "&from=" . $from . "&to=" . $to . "&max=" . $max . "'>
                    <button type='button' class='btn btn-primary'";
        if ($max < 1 || $max === null) echo " disabled";
        echo ">Book Appointment</button>
                </a>
            </td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}
require_once __DIR__ . '/inc/footer.php' ?>