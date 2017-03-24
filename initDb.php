<?php require_once __DIR__ . '/inc/connection.php';
$password = password_hash("nutella",PASSWORD_DEFAULT);
$stmt = $db->prepare("INSERT INTO user_t
                      (first_name,	last_name,	user_password)
                      VALUES
                      ('Albert', 'Einstein', ?);
                      INSERT INTO supervisor_t
                      (staff_number,	title_id,	end_date, id)
                      VALUES
                      (123456789, 2, DATE_ADD(CURRENT_DATE ,INTERVAL 2 MONTH),LAST_INSERT_ID());");
$stmt->bindParam(1,$password,PDO::PARAM_STR);
$stmt->execute();

$stmt = $db->prepare("INSERT INTO schedule_t
                      (day_id,	staff_number)
                      VALUES
                      (1, 123456789),
                      (2, 123456789),
                      (3, 123456789),
                      (4, 123456789),
                      (5, 123456789),
                      (6, 123456789),
                      (7, 123456789)");
$stmt->execute();