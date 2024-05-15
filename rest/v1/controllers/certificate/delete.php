<?php
$conn = null;
$conn = checkDbConnection();
$certificate = new Certificate($conn);

$error = [];
$returnData = [];
if (array_key_exists("certificateid", $_GET)) {
    $certificate->certificate_aid = $_GET['certificateid'];
    checkId($certificate->certificate_aid);

    $query = checkDelete($certificate);
    returnSuccess($certificate, "certificate", $query);
}

checkEndpoint();