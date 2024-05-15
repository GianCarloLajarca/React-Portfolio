<?php
$conn = null;
$conn = checkDbConnection();
$top = new Top($conn);

$error = [];
$returnData = [];
if (array_key_exists("topid", $_GET)) {
    $top->top_aid = $_GET['topid'];
    checkId($top->top_aid);

    $query = checkDelete($top);
    returnSuccess($top, "top", $query);
}

checkEndpoint();