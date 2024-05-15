<?php
require '../../core/header.php';
require '../../core/functions.php';
require '../../models/Honor.php';

$conn = null;
$conn = checkDbConnection();

$honor = new Honor($conn);

$body = file_get_contents("php://input");
$data = json_decode($body, true);


if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    checkApiKey();
    if (array_key_exists("honorid", $_GET)) {

        checkPayload($data);
        $honor->honor_aid = $_GET['honorid'];
        $honor->honor_is_active = trim($data["isActive"]);
        $honor->honor_datetime = date("Y-m-d H:i:s");
        checkId($honor->honor_aid);
        $query = checkActive($honor);
        http_response_code(200);
        returnSuccess($honor, "honor", $query);
    }
    checkEndpoint();
}

http_response_code(200);
// header('HTTP/1.0 401 Unauthorized');
checkAccess();