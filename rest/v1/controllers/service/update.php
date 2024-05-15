<?php
$conn = null;
$conn = checkDbConnection();
$service = new Service($conn);
$error = [];
$returnData = [];
if (array_key_exists("serviceid", $_GET)) {
    checkPayload($data);
    $service->service_aid = $_GET['serviceid'];
    $service->service_title = checkIndex($data, "service_title");
    $service->service_photo = checkIndex($data, "service_photo");
    $service->service_publish_date = checkIndex($data, "service_publish_date");
    $service->service_datetime = date("Y-m-d H:i:s");
    
    checkId($service->service_aid);
    // $service_name_old = checkIndex($data, "service_name_old");
    // compareName($service, $service_name_old, $service->service_name);
    $query = checkUpdate($service);
    returnSuccess($service, "service", $query);
}

checkEndpoint();