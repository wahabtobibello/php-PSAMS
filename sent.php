<?php
require_once __DIR__ . '/inc/bootstrap.php';
requireAuth();
require_once __DIR__ . '/inc/header.php' ?>
<h3 class="mt-4 mb-3">Sent Messages</h3>
<hr/>
<table class="table table-striped table-hover">
    <?php
    foreach (getSentMessages() as $item) {
        $firstName = $item['first_name'];
        $lastName = $item['last_name'];
        $recipientId = $item['user_number'];
        $subject = $item['subject'];
        $text = $item['text_message'];
        $sentOn = $item['send_time'];
        echo "<tr><td scope='row'> To: $firstName $lastName &lt;$recipientId&gt; </td>";
        echo "<td>$subject</td>";
        echo "<td>$sentOn</td>";
        echo "<td>
                <button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\"
                        data-target='#viewMessageModal' data-subject='" . $subject . "'data-text='" . $text . "'>View
                </button>
                <button type=\"button\" class=\"btn btn-outline-info\" data-toggle=\"modal\" data-target=\"#compose\"
                data-type='compose' data-recipient='" . $recipientId . "'>Message</button>
             </td></tr>";
    }
    ?>
    <?php include_once __DIR__ . '/inc/viewMessageModal.php' ?>
    <?php include_once __DIR__ . '/inc/composeMessageModal.php' ?>
</table>
<?php require_once __DIR__ . '/inc/footer.php' ?>
