<?php
$conn = null;
$conn = checkDbConnection();
$experience = new Experience($conn);
$error = [];
$returnData = [];

if (empty($_GET)) {
    $query = checkReadAll($experience);
    http_response_code(200);
    getQueriedData($query);
}

checkEndpoint();