<?php
$conn = null;
$conn = checkDbConnection();
$education = new Education($conn);
$error = [];
$returnData = [];

if (empty($_GET)) {
    $query = checkReadAll($education);
    http_response_code(200);
    getQueriedData($query);
}

checkEndpoint();