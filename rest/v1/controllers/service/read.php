<?php
$conn = null;
$conn = checkDbConnection();
$service = new Service($conn);
$error = [];
$returnData = [];

if (empty($_GET)) {
    $query = checkReadAll($service);
    http_response_code(200);
    getQueriedData($query);
}

checkEndpoint();