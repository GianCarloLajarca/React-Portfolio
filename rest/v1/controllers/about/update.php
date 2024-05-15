<?php
$conn = null;
$conn = checkDbConnection();
$about = new About($conn);
$error = [];
$returnData = [];
if (array_key_exists("aboutid", $_GET)) {
    checkPayload($data);
    $about->about_aid = $_GET['aboutid'];
    $about->about_title = checkIndex($data, "about_title");
    $about->about_photo = checkIndex($data, "about_photo");
    $about->about_description = checkIndex($data, "about_description");
    $about->about_detail = checkIndex($data, "about_detail");
    $about->about_name = checkIndex($data, "about_name");
    $about->about_email = checkIndex($data, "about_email");
    $about->about_phone = checkIndex($data, "about_phone");
    $about->about_birthday = checkIndex($data, "about_birthday");
    $about->about_nationality = checkIndex($data, "about_nationality");
    $about->about_address = checkIndex($data, "about_address");
    $about->about_publish_date = checkIndex($data, "about_publish_date");
    $about->about_datetime = date("Y-m-d H:i:s");
    
    checkId($about->about_aid);
    // $about_name_old = checkIndex($data, "about_name_old");
    // compareName($about, $about_name_old, $about->about_name);
    $query = checkUpdate($about);
    returnSuccess($about, "about", $query);
}

checkEndpoint();