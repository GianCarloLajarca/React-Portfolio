<?php
require '../../core/header.php';
require '../../core/functions.php';
require '../../models/Experience.php';

$conn = null;
$conn = checkDbConnection();

$experience = new Experience($conn);

$body = file_get_contents("php://input");
$data = json_decode($body, true);


if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    checkApiKey();
    if (array_key_exists("experienceid", $_GET)) {

        checkPayload($data);
        $experience->experience_aid = $_GET['experienceid'];
        $experience->experience_is_active = trim($data["isActive"]);
        $experience->experience_datetime = date("Y-m-d H:i:s");
        checkId($experience->experience_aid);
        $query = checkActive($experience);
        http_response_code(200);
        returnSuccess($experience, "experience", $query);
    }
    checkEndpoint();
}

http_response_code(200);
// header('HTTP/1.0 401 Unauthorized');
checkAccess();