<?php
$conn = null;
$conn = checkDbConnection();
$experience = new Experience($conn);
$error = [];
$returnData = [];
if (array_key_exists("experienceid", $_GET)) {
    checkPayload($data);
    $experience->experience_aid = $_GET['experienceid'];
    $experience->experience_title = checkIndex($data, "experience_title");
    $experience->experience_photo = checkIndex($data, "experience_photo");
    $experience->experience_description = checkIndex($data, "experience_description");
    $experience->experience_date = checkIndex($data, "experience_date");
    $experience->experience_job = checkIndex($data, "experience_job");
    $experience->experience_publish_date = checkIndex($data, "experience_publish_date");
    $experience->experience_datetime = date("Y-m-d H:i:s");
    
    checkId($experience->experience_aid);
    // $experience_name_old = checkIndex($data, "experience_name_old");
    // compareName($experience, $experience_name_old, $experience->experience_name);
    $query = checkUpdate($experience);
    returnSuccess($experience, "experience", $query);
}

checkEndpoint();