<?php
require '../../core/header.php';
require '../../core/functions.php';
require '../../models/Cta.php';

$conn = null;
$conn = checkDbConnection();

$cta = new Cta($conn);

$body = file_get_contents("php://input");
$data = json_decode($body, true);


if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    checkApiKey();
    if (array_key_exists("ctaid", $_GET)) {

        checkPayload($data);
        $cta->cta_aid = $_GET['ctaid'];
        $cta->cta_is_active = trim($data["isActive"]);
        $cta->cta_datetime = date("Y-m-d H:i:s");
        checkId($cta->cta_aid);
        $query = checkActive($cta);
        http_response_code(200);
        returnSuccess($cta, "cta", $query);
    }
    checkEndpoint();
}

http_response_code(200);
// header('HTTP/1.0 401 Unauthorized');
checkAccess();