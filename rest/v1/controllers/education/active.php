<?php
require '../../core/header.php';
require '../../core/functions.php';
require '../../models/Education.php';

$conn = null;
$conn = checkDbConnection();

$education = new Education($conn);

$body = file_get_contents("php://input");
$data = json_decode($body, true);


if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    checkApiKey();
    if (array_key_exists("educationid", $_GET)) {

        checkPayload($data);
        $education->education_aid = $_GET['educationid'];
        $education->education_is_active = trim($data["isActive"]);
        $education->education_datetime = date("Y-m-d H:i:s");
        checkId($education->education_aid);
        $query = checkActive($education);
        http_response_code(200);
        returnSuccess($education, "education", $query);
    }
    checkEndpoint();
}

http_response_code(200);
// header('HTTP/1.0 401 Unauthorized');
checkAccess();