<?php
$conn = null;
$conn = checkDbConnection();
$education = new Education($conn);

$error = [];
$returnData = [];
if (array_key_exists("educationid", $_GET)) {
    $education->education_aid = $_GET['educationid'];
    checkId($education->education_aid);

    $query = checkDelete($education);
    returnSuccess($education, "education", $query);
}

checkEndpoint();