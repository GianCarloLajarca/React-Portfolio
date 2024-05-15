<?php
$conn = null;
$conn = checkDbConnection();
$honor = new Honor($conn);
$error = [];
$returnData = [];

if (empty($_GET)) {
    $query = checkReadAll($honor);
    http_response_code(200);
    getQueriedData($query);
}

checkEndpoint();