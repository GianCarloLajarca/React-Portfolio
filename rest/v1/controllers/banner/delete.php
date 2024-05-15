<?php
$conn = null;
$conn = checkDbConnection();
$banner = new Banner($conn);

$error = [];
$returnData = [];
if (array_key_exists("bannerid", $_GET)) {
    $banner->banner_aid = $_GET['bannerid'];
    checkId($banner->banner_aid);

    $query = checkDelete($banner);
    returnSuccess($banner, "banner", $query);
}

checkEndpoint();