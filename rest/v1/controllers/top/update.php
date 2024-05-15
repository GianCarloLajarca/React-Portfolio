<?php
$conn = null;
$conn = checkDbConnection();
$top = new Top($conn);
$error = [];
$returnData = [];
if (array_key_exists("topid", $_GET)) {
    checkPayload($data);
    $top->top_aid = $_GET['topid'];
    $top->top_title = checkIndex($data, "top_title");
    $top->top_photo = checkIndex($data, "top_photo");
    $top->top_publish_date = checkIndex($data, "top_publish_date");
    $top->top_date = checkIndex($data, "top_date");
    $top->top_giver = checkIndex($data, "top_giver");
    $top->top_datetime = date("Y-m-d H:i:s");
    
    checkId($top->top_aid);
    // $top_name_old = checkIndex($data, "top_name_old");
    // compareName($top, $top_name_old, $top->top_name);
    $query = checkUpdate($top);
    returnSuccess($top, "top", $query);
}

checkEndpoint();