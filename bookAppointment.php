<?php
require_once __DIR__ . '/inc/bootstrap.php';
requireAuth();
require_once __DIR__ . '/inc/header.php';
?>
    <h3 class="mt-4 mb-3">Book Appointment</h3>
    <hr/>
    <form method="post" action="procedures/doBooking.php">
        <div class="form-group row offset-md-3">
            <label for="appointmentDay" class="col-2 col-form-label">Pick a Day</label>
            <div class="col-10">
                <select class="custom-select" name="appointmentDay" id="appointmentDay">
                    <option selected>----</option>
                    <option value="1">Monday</option>
                    <option value="2">Tuesday</option>
                    <option value="3">Wednesday</option>
                    <option value="4">Thursday</option>
                    <option value="5">Friday</option>
                    <option value="6">Saturday</option>
                    <option value="7">Sunday</option>
                </select>
            </div>
        </div>
        <div class="form-group row offset-md-3">
            <label for="appointmentTime" class="col-2 col-form-label">Pick a Time</label>
            <div class="col-6">
                <input class="form-control" type="time" value="13:45:00" id="appointmentTime" name="appointmentTime">
            </div>
        </div>
        <button type="submit" class="btn btn-primary offset-md-8">Submit</button>
    </form>
<?php include_once __DIR__ . '/inc/footer.php' ?>