<?php
require '../../core/header.php';
require '../../core/functions.php';
require '../../models/Certificate.php';

$conn = null;
$conn = checkDbConnection();

$certificate = new Certificate($conn);

$body = file_get_contents("php://input");
$data = json_decode($body, true);


if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    checkApiKey();
    if (array_key_exists("certificateid", $_GET)) {

        checkPayload($data);
        $certificate->certificate_aid = $_GET['certificateid'];
        $certificate->certificate_is_active = trim($data["isActive"]);
        $certificate->certificate_datetime = date("Y-m-d H:i:s");
        checkId($certificate->certificate_aid);
        $query = checkActive($certificate);
        http_response_code(200);
        returnSuccess($certificate, "certificate", $query);
    }
    checkEndpoint();
}

http_response_code(200);
// header('HTTP/1.0 401 Unauthorized');
checkAccess();