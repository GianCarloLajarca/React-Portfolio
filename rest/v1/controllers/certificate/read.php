<?php
$conn = null;
$conn = checkDbConnection();
$certificate = new Certificate($conn);
$error = [];
$returnData = [];

if (empty($_GET)) {
    $query = checkReadAll($certificate);
    http_response_code(200);
    getQueriedData($query);
}

checkEndpoint();