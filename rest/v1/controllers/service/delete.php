<?php
$conn = null;
$conn = checkDbConnection();
$service = new Service($conn);

$error = [];
$returnData = [];
if (array_key_exists("serviceid", $_GET)) {
    $service->service_aid = $_GET['serviceid'];
    checkId($service->service_aid);

    $query = checkDelete($service);
    returnSuccess($service, "service", $query);
}

checkEndpoint();