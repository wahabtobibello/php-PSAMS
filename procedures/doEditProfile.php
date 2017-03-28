<?php require __DIR__ . '/../inc/bootstrap.php';
$picture = $_FILES['picture'];
$firstName = request()->get('firstName');
$lastName = request()->get('lastName');
$project = request()->get('project');
$matricNo = request()->get('matric');

$user = findUser();
$fileSizeLimit = 500000;
$uploadDir = "../img/uploads/";
$pictureFile = $uploadDir . basename($picture['name']);
$uploadOk = 1;
$imageFileType = pathinfo($pictureFile, PATHINFO_EXTENSION);
$pictureFile = $uploadDir . $user['user_number'] . "." . $imageFileType;
// Check if image file is a actual image or fake image
if (!empty($picture['name'])) {
    $check = getimagesize($picture["tmp_name"]);
    if ($check === false) {
        $uploadOk = 0;
    }
// Check file size
    if ($picture["size"] > $fileSizeLimit) {
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $session->getFlashBag()->add('error', "Error file format");
        // if everything is ok, try to upload file
    } else {
        if (file_exists($pictureFile)) {
            unlink("$pictureFile");
        }
        var_dump($pictureFile);
        if (move_uploaded_file($picture["tmp_name"], $pictureFile)) {
            $session->getFlashBag()->add('success', "Profile picture upload");
        } else {
            $session->getFlashBag()->add('error', "Profile picture not upload");
            redirect('/viewProfile.php');
        }
    }
}else{
    $pictureFile = null;
}
try {
    updateProfile($firstName, $lastName, $project, $matricNo, $pictureFile);
    $session->getFlashBag()->add('success', 'Profile Updated');
    redirect('/viewProfile.php');
} catch (\Exception $e) {
    $session->getFlashBag()->add('error', 'Error updating profile');
    redirect('/viewProfile.php');
}
