<?php
$conn = null;
$conn = checkDbConnection();
$certificate = new Certificate($conn);
if (array_key_exists("certificateid", $_GET)) {
    checkEndpoint();
}
checkPayload($data);
$certificate->certificate_title = checkIndex($data, "certificate_title");
$certificate->certificate_photo = checkIndex($data, "certificate_photo");
$certificate->certificate_is_active = 1;
$certificate->certificate_publish_date = checkIndex($data, "certificate_publish_date");
$certificate->certificate_date = checkIndex($data, "certificate_date");
$certificate->certificate_organization = checkIndex($data, "certificate_organization");
$certificate->certificate_created = date("Y-m-d H:i:s");
$certificate->certificate_datetime = date("Y-m-d H:i:s");

// isNameExist($certificate, $certificate->certificate_title);

$query = checkCreate($certificate);
returnSuccess($certificate, "certificate", $query);