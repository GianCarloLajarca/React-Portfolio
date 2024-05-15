<?php
$conn = null;
$conn = checkDbConnection();
$education = new Education($conn);
if (array_key_exists("educationid", $_GET)) {
    checkEndpoint();
}
checkPayload($data);
$education->education_title = checkIndex($data, "education_title");
$education->education_photo = checkIndex($data, "education_photo");
$education->education_is_active = 1;
$education->education_publish_date = checkIndex($data, "education_publish_date");
$education->education_description = checkIndex($data, "education_description");
$education->education_school = checkIndex($data, "education_school");
$education->education_date = checkIndex($data, "education_date");
$education->education_created = date("Y-m-d H:i:s");
$education->education_datetime = date("Y-m-d H:i:s");

// isNameExist($education, $education->education_title);

$query = checkCreate($education);
returnSuccess($education, "education", $query);