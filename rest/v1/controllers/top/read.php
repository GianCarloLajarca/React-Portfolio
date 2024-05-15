<?php
$conn = null;
$conn = checkDbConnection();
$top = new Top($conn);
$error = [];
$returnData = [];

if (empty($_GET)) {
    $query = checkReadAll($top);
    http_response_code(200);
    getQueriedData($query);
}

checkEndpoint();