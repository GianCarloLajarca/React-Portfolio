<?php
require '../../core/header.php';
require '../../core/functions.php';
require '../../models/Banner.php';

$conn = null;
$conn = checkDbConnection();

$banner = new Banner($conn);

$body = file_get_contents("php://input");
$data = json_decode($body, true);


if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    checkApiKey();
    if (array_key_exists("bannerid", $_GET)) {

        checkPayload($data);
        $banner->banner_aid = $_GET['bannerid'];
        $banner->banner_is_active = trim($data["isActive"]);
        $banner->banner_datetime = date("Y-m-d H:i:s");
        checkId($banner->banner_aid);
        $query = checkActive($banner);
        http_response_code(200);
        returnSuccess($banner, "banner", $query);
    }
    checkEndpoint();
}

http_response_code(200);
// header('HTTP/1.0 401 Unauthorized');
checkAccess();