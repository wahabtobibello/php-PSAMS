<?php
$sender = findUser();
$recipientID = request()->get('recipient');
$subject = request()->get('subject');
$message = request()->get('messageText');