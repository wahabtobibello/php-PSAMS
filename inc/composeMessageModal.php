<div class="modal fade" id="compose" tabindex="-1" role="dialog" aria-labelledby="compose"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="compose">Compose</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="../procedures/sendMessage.php">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient" class="form-control-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient" value="John Doe <130805000>"
                               name="recipient" readonly>
                    </div>
                    <div class="form-group">
                        <label for="subject" class="form-control-label">Subject:</label>
                        <input type="text" class="form-control" id="subject" name="subject">
                    </div>
                    <input type="datetime" class="form-control hidden-xs-up" id="time" name="time" value="">
                    <div class="form-group">
                        <label for="message-text" class="form-control-label">Message:</label>
                        <textarea class="form-control" id="messageText" name="messageText"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>