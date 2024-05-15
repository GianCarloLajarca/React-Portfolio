<?php
$conn = null;
$conn = checkDbConnection();
$service = new Service($conn);
if (array_key_exists("serviceid", $_GET)) {
    checkEndpoint();
}
checkPayload($data);
$service->service_title = checkIndex($data, "service_title");
$service->service_photo = checkIndex($data, "service_photo");
$service->service_is_active = 1;
$service->service_publish_date = checkIndex($data, "service_publish_date");
$service->service_created = date("Y-m-d H:i:s");
$service->service_datetime = date("Y-m-d H:i:s");

// isNameExist($service, $service->service_title);

$query = checkCreate($service);
returnSuccess($service, "service", $query);