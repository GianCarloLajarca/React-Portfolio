<?php
$conn = null;
$conn = checkDbConnection();
$banner = new Banner($conn);
$error = [];
$returnData = [];

if (empty($_GET)) {
    $query = checkReadAll($banner);
    http_response_code(200);
    getQueriedData($query);
}

checkEndpoint();