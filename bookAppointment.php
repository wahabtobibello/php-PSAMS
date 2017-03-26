<?php
require_once __DIR__ . '/inc/bootstrap.php';
requireAuth();
requireStudent();
require_once __DIR__ . '/inc/header.php';

$dayId = request()->get('id');
$day = request()->get('day');
$from = request()->get('from');
$to = request()->get('to');
$endDate = strtotime(request()->get('endDate'));
$nextDate = date('d-M-Y', strtotime("next $day"));
$dates = [];
while ($endDate > strtotime($nextDate)) {
//    var_dump(numberOfSlotsLeftOnDate($nextDate));
    if (numberOfSlotsLeftOnDate($nextDate) > 0) {
        $dates[] = $nextDate;
    }
    $nextDate = date('d-M-Y', strtotime("$nextDate + 7 days"));
}
?>
    <h3 class="mt-4 mb-3">Book Appointment</h3>
    <hr/>
<?php echo displayErrors();
echo displaySuccess();
echo displayInfo(); ?>
    <form method="post" action="procedures/doBooking.php?id=<?php echo "$dayId" ?>">
        <div class="form-group row offset-md-3">
            <label for="appointmentDate" class="col-2 col-form-label">Pick a Date</label>
            <div class="col-10">
                <select class="custom-select" name="appointmentDate" id="appointmentDate" required>
                    <option selected>----</option>
                    <?php foreach ($dates as $date) {
                        echo "<option value='$date'>$date</option>";
                    } ?>
                </select>
            </div>
        </div>
        <div class="form-group row offset-md-3">
            <label for="appointmentTime" class="col-2 col-form-label">Pick a Time</label>
            <div class="col-6">
                <input class="form-control" type="time" value="" id="appointmentTime" name="appointmentTime"
                    <?php echo " min='" . $from . "' max='" . $to . "'" ?> required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary offset-md-8">Submit</button>
    </form>
<?php include_once __DIR__ . '/inc/footer.php' ?>