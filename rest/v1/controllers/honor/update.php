<?php
$conn = null;
$conn = checkDbConnection();
$honor = new Honor($conn);
$error = [];
$returnData = [];
if (array_key_exists("honorid", $_GET)) {
    checkPayload($data);
    $honor->honor_aid = $_GET['honorid'];
    $honor->honor_title = checkIndex($data, "honor_title");
    $honor->honor_photo = checkIndex($data, "honor_photo");
    $honor->honor_date = checkIndex($data, "honor_date");
    $honor->honor_giver = checkIndex($data, "honor_giver");
    $honor->honor_publish_date = checkIndex($data, "honor_publish_date");
    $honor->honor_datetime = date("Y-m-d H:i:s");
    
    checkId($honor->honor_aid);
    // $honor_name_old = checkIndex($data, "honor_name_old");
    // compareName($honor, $honor_name_old, $honor->honor_name);
    $query = checkUpdate($honor);
    returnSuccess($honor, "honor", $query);
}

checkEndpoint();