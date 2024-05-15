<?php
$conn = null;
$conn = checkDbConnection();
$cta = new Cta($conn);
$error = [];
$returnData = [];
if (array_key_exists("ctaid", $_GET)) {
    checkPayload($data);
    $cta->cta_aid = $_GET['ctaid'];
    $cta->cta_title = checkIndex($data, "cta_title");
    $cta->cta_subtitle = checkIndex($data, "cta_subtitle");
    $cta->cta_button = checkIndex($data, "cta_button");
    $cta->cta_publish_date = checkIndex($data, "cta_publish_date");
    $cta->cta_datetime = date("Y-m-d H:i:s");
    
    checkId($cta->cta_aid);
    // $cta_name_old = checkIndex($data, "cta_name_old");
    // compareName($cta, $cta_name_old, $cta->cta_name);
    $query = checkUpdate($cta);
    returnSuccess($cta, "cta", $query);
}

checkEndpoint();