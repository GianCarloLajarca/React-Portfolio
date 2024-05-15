<?php
$conn = null;
$conn = checkDbConnection();
$honor = new Honor($conn);
if (array_key_exists("honorid", $_GET)) {
    checkEndpoint();
}
checkPayload($data);
$honor->honor_title = checkIndex($data, "honor_title");
$honor->honor_photo = checkIndex($data, "honor_photo");
$honor->honor_is_active = 1;
$honor->honor_publish_date = checkIndex($data, "honor_publish_date");
$honor->honor_date = checkIndex($data, "honor_date");
$honor->honor_giver = checkIndex($data, "honor_giver");
$honor->honor_created = date("Y-m-d H:i:s");
$honor->honor_datetime = date("Y-m-d H:i:s");

// isNameExist($honor, $honor->honor_title);

$query = checkCreate($honor);
returnSuccess($honor, "honor", $query);