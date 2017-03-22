<?php require_once __DIR__ . '/inc/header.php' ?>
    <h3 class="mt-4 mb-3">Inbox</h3>
    <hr/>
    <table class="table table-striped table-hover">
        <tr>
            <td scope="row">John Doe <130805000>
            </td>
            <td>&lt;Subject goes here&gt;</td>
            <td>&lt;Date goes here&gt;</td>
            <td>
                <button type="button" class="btn btn-outline-info" data-toggle="modal"
                        data-target="#viewMessageModal">View
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#replyMessageModal">Reply
                </button>
            </td>
        </tr>
        <div class="modal fade" id="viewMessageModal" tabindex="-1" role="dialog" aria-labelledby="viewMessage"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewMessage">Message Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <p>&lt;Subject goes there&gt;</p>
                                <p class="form-control">Sed ut perspiciatis unde omnis iste natus error sit
                                    voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae
                                    ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
                                    explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut
                                    fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi
                                    nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet,
                                    consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut
                                    labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam,
                                    quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid
                                    ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea
                                    voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum
                                    fugiat quo voluptas nulla pariatur?
                                </p>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="replyMessageModal" tabindex="-1" role="dialog" aria-labelledby="replyMessage"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="replyMessage">Compose</h5>
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
    </table>
<?php require_once __DIR__ . '/inc/footer.php' ?>