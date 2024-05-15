<?php
$conn = null;
$conn = checkDbConnection();
$honor = new Honor($conn);

$error = [];
$returnData = [];
if (array_key_exists("honorid", $_GET)) {
    $honor->honor_aid = $_GET['honorid'];
    checkId($honor->honor_aid);

    $query = checkDelete($honor);
    returnSuccess($honor, "honor", $query);
}

checkEndpoint();