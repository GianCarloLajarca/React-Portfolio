<?php
$conn = null;
$conn = checkDbConnection();
$education = new Education($conn);
$error = [];
$returnData = [];
if (array_key_exists("educationid", $_GET)) {
    checkPayload($data);
    $education->education_aid = $_GET['educationid'];
    $education->education_title = checkIndex($data, "education_title");
    $education->education_photo = checkIndex($data, "education_photo");
    $education->education_description = checkIndex($data, "education_description");
    $education->education_school = checkIndex($data, "education_school");
    $education->education_date = checkIndex($data, "education_date");
    $education->education_publish_date = checkIndex($data, "education_publish_date");
    $education->education_datetime = date("Y-m-d H:i:s");
    
    checkId($education->education_aid);
    // $education_name_old = checkIndex($data, "education_name_old");
    // compareName($education, $education_name_old, $education->education_name);
    $query = checkUpdate($education);
    returnSuccess($education, "education", $query);
}

checkEndpoint();