<?php
$conn = null;
$conn = checkDbConnection();
$banner = new Banner($conn);
$error = [];
$returnData = [];
if (array_key_exists("bannerid", $_GET)) {
    checkPayload($data);
    $banner->banner_aid = $_GET['bannerid'];
    $banner->banner_greet = checkIndex($data, "banner_greet");
    $banner->banner_photo = checkIndex($data, "banner_photo");
    $banner->banner_firstname = checkIndex($data, "banner_firstname");
    $banner->banner_lastname = checkIndex($data, "banner_lastname");
    $banner->banner_name = checkIndex($data, "banner_name");
    $banner->banner_description = checkIndex($data, "banner_description");
    $banner->banner_button = checkIndex($data, "banner_button");
    $banner->banner_scroll = checkIndex($data, "banner_scroll");
    $banner->banner_publish_date = checkIndex($data, "banner_publish_date");
    $banner->banner_datetime = date("Y-m-d H:i:s");
    
    checkId($banner->banner_aid);
    // $banner_name_old = checkIndex($data, "banner_name_old");
    // compareName($banner, $banner_name_old, $banner->banner_name);
    $query = checkUpdate($banner);
    returnSuccess($banner, "banner", $query);
}

checkEndpoint();