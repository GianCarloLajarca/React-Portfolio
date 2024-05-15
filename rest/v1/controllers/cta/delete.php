<?php
$conn = null;
$conn = checkDbConnection();
$cta = new Cta($conn);

$error = [];
$returnData = [];
if (array_key_exists("ctaid", $_GET)) {
    $cta->cta_aid = $_GET['ctaid'];
    checkId($cta->cta_aid);

    $query = checkDelete($cta);
    returnSuccess($cta, "cta", $query);
}

checkEndpoint();