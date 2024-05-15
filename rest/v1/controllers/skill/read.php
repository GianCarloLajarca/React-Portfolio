<?php
$conn = null;
$conn = checkDbConnection();
$skill = new Skill($conn);
$error = [];
$returnData = [];

if (empty($_GET)) {
    $query = checkReadAll($skill);
    http_response_code(200);
    getQueriedData($query);
}

checkEndpoint();