<?php
$conn = null;
$conn = checkDbConnection();
$banner = new Banner($conn);
if (array_key_exists("bannerid", $_GET)) {
    checkEndpoint();
}
checkPayload($data);
$banner->banner_greet = checkIndex($data, "banner_greet");
$banner->banner_photo = checkIndex($data, "banner_photo");
$banner->banner_firstname = checkIndex($data, "banner_firstname");
$banner->banner_lastname = checkIndex($data, "banner_lastname");
$banner->banner_name = checkIndex($data, "banner_name");
$banner->banner_is_active = 1;
$banner->banner_publish_date = checkIndex($data, "banner_publish_date");
$banner->banner_description = checkIndex($data, "banner_description");
$banner->banner_button = checkIndex($data, "banner_button");
$banner->banner_scroll = checkIndex($data, "banner_scroll");
$banner->banner_created = date("Y-m-d H:i:s");
$banner->banner_datetime = date("Y-m-d H:i:s");

// isNameExist($banner, $banner->banner_title);

$query = checkCreate($banner);
returnSuccess($banner, "banner", $query);