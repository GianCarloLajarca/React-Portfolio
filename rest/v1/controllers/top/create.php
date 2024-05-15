<?php
$conn = null;
$conn = checkDbConnection();
$top = new Top($conn);
if (array_key_exists("topid", $_GET)) {
    checkEndpoint();
}
checkPayload($data);
$top->top_title = checkIndex($data, "top_title");
$top->top_photo = checkIndex($data, "top_photo");
$top->top_is_active = 1;
$top->top_publish_date = checkIndex($data, "top_publish_date");
$top->top_date = checkIndex($data, "top_date");
$top->top_giver = checkIndex($data, "top_giver");
$top->top_created = date("Y-m-d H:i:s");
$top->top_datetime = date("Y-m-d H:i:s");

// isNameExist($top, $top->top_title);

$query = checkCreate($top);
returnSuccess($top, "top", $query);