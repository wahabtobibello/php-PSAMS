<?php require_once __DIR__ . '/inc/header.php' ?>
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
            </th>
            <td>130805000</td>
            <td>Monday</td>
            <td>02:00pm</td>
            <td>
                <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#messageModal">
                    Message
                </button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelMessageModal">
                    Cancel
                </button>
            </td>
        </tr>
        <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="message"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="message">Compose</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="recipient" class="form-control-label">Recipient:</label>
                                <input type="text" class="form-control" id="recipient" value="John Doe <130805000>"
                                       disabled>
                            </div>
                            <div class="form-group">
                                <label for="subject" class="form-control-label">Subject:</label>
                                <input type="text" class="form-control" id="subject">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="form-control-label">Message:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="cancelMessageModal" tabindex="-1" role="dialog" aria-labelledby="cancelMessage"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelMessage">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="cancelRecipient" class="form-control-label">Recipient:</label>
                                <input type="text" class="form-control" id="cancelRecipient"
                                       value="John Doe <130805000>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="cancelSubject" class="form-control-label">Subject:</label>
                                <input type="text" class="form-control" id="cancelSubject" value="Cancelled Appointment"
                                       disabled>
                            </div>
                            <div class="form-group">
                                <label for="cancelMessageText" class="form-control-label">Message:</label>
                                <textarea class="form-control" id="cancelMessageText"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        </tbody>

</table>
<?php require_once __DIR__ . '/inc/footer.php' ?>