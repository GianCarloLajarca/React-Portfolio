<?php
require '../../core/header.php';
require '../../core/functions.php';
require '../../models/Service.php';

$conn = null;
$conn = checkDbConnection();

$service = new Service($conn);

$body = file_get_contents("php://input");
$data = json_decode($body, true);


if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    checkApiKey();
    if (array_key_exists("serviceid", $_GET)) {

        checkPayload($data);
        $service->service_aid = $_GET['serviceid'];
        $service->service_is_active = trim($data["isActive"]);
        $service->service_datetime = date("Y-m-d H:i:s");
        checkId($service->service_aid);
        $query = checkActive($service);
        http_response_code(200);
        returnSuccess($service, "service", $query);
    }
    checkEndpoint();
}

http_response_code(200);
// header('HTTP/1.0 401 Unauthorized');
checkAccess();
