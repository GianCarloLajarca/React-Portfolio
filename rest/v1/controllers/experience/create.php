<?php
$conn = null;
$conn = checkDbConnection();
$experience = new Experience($conn);
if (array_key_exists("experienceid", $_GET)) {
    checkEndpoint();
}
checkPayload($data);
$experience->experience_title = checkIndex($data, "experience_title");
$experience->experience_photo = checkIndex($data, "experience_photo");
$experience->experience_is_active = 1;
$experience->experience_publish_date = checkIndex($data, "experience_publish_date");
$experience->experience_description = checkIndex($data, "experience_description");
$experience->experience_date = checkIndex($data, "experience_date");
$experience->experience_job = checkIndex($data, "experience_job");
$experience->experience_created = date("Y-m-d H:i:s");
$experience->experience_datetime = date("Y-m-d H:i:s");

// isNameExist($experience, $experience->experience_title);

$query = checkCreate($experience);
returnSuccess($experience, "experience", $query);