<?php
$conn = null;
$conn = checkDbConnection();
$cta = new Cta($conn);
if (array_key_exists("ctaid", $_GET)) {
    checkEndpoint();
}
checkPayload($data);
$cta->cta_title = checkIndex($data, "cta_title");
$cta->cta_subtitle = checkIndex($data, "cta_subtitle");
$cta->cta_button = checkIndex($data, "cta_button");
$cta->cta_is_active = 1;
$cta->cta_publish_date = checkIndex($data, "cta_publish_date");
$cta->cta_created = date("Y-m-d H:i:s");
$cta->cta_datetime = date("Y-m-d H:i:s");

// isNameExist($cta, $cta->cta_title);

$query = checkCreate($cta);
returnSuccess($cta, "cta", $query);