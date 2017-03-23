<?php require_once __DIR__ . '/inc/connection.php';
$password = password_hash("nutella",PASSWORD_DEFAULT);
$stmt = $db->prepare("INSERT INTO supervisor_t
                    (staff_number,	first_name,	last_name,	user_password,	title_id,	end_date)
                     VALUES
                    (123456789, 'Albert', 'Einstein', ?, 2, DATE_ADD(CURRENT_DATE ,INTERVAL 2 MONTH))");
$stmt->bindParam(1,$password,PDO::PARAM_STR);
$stmt->execute();