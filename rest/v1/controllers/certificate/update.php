<?php
$conn = null;
$conn = checkDbConnection();
$certificate = new Certificate($conn);
$error = [];
$returnData = [];
if (array_key_exists("certificateid", $_GET)) {
    checkPayload($data);
    $certificate->certificate_aid = $_GET['certificateid'];
    $certificate->certificate_title = checkIndex($data, "certificate_title");
    $certificate->certificate_photo = checkIndex($data, "certificate_photo");
    $certificate->certificate_date = checkIndex($data, "certificate_date");
    $certificate->certificate_organization = checkIndex($data, "certificate_organization");
    $certificate->certificate_publish_date = checkIndex($data, "certificate_publish_date");
    $certificate->certificate_datetime = date("Y-m-d H:i:s");
    
    checkId($certificate->certificate_aid);
    // $certificate_name_old = checkIndex($data, "certificate_name_old");
    // compareName($certificate, $certificate_name_old, $certificate->certificate_name);
    $query = checkUpdate($certificate);
    returnSuccess($certificate, "certificate", $query);
}

checkEndpoint();