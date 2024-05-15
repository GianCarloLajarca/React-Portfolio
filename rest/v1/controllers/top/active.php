<?php
require '../../core/header.php';
require '../../core/functions.php';
require '../../models/Top.php';

$conn = null;
$conn = checkDbConnection();

$top = new Top($conn);

$body = file_get_contents("php://input");
$data = json_decode($body, true);


if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    checkApiKey();
    if (array_key_exists("topid", $_GET)) {

        checkPayload($data);
        $top->top_aid = $_GET['topid'];
        $top->top_is_active = trim($data["isActive"]);
        $top->top_datetime = date("Y-m-d H:i:s");
        checkId($top->top_aid);
        $query = checkActive($top);
        http_response_code(200);
        returnSuccess($top, "top", $query);
    }
    checkEndpoint();
}

http_response_code(200);
// header('HTTP/1.0 401 Unauthorized');
checkAccess();