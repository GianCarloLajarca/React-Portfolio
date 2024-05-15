<?php
$conn = null;
$conn = checkDbConnection();
$contact = new Contact($conn);
$error = [];
$returnData = [];
if (array_key_exists("contactid", $_GET)) {
    checkPayload($data);
    $contact->contact_aid = $_GET['contactid'];
    $contact->contact_title = checkIndex($data, "contact_title");
    $contact->contact_paragraph = checkIndex($data, "contact_paragraph");
    $contact->contact_phone = checkIndex($data, "contact_phone");
    $contact->contact_emailaddress = checkIndex($data, "contact_emailaddress");
    $contact->contact_address = checkIndex($data, "contact_address");
    $contact->contact_button = checkIndex($data, "contact_button");
    $contact->contact_name = checkIndex($data, "contact_name");
    $contact->contact_email = checkIndex($data, "contact_email");
    $contact->contact_message = checkIndex($data, "contact_message");
    $contact->contact_publish_date = checkIndex($data, "contact_publish_date");
    $contact->contact_datetime = date("Y-m-d H:i:s");
    
    checkId($contact->contact_aid);
    // $contact_name_old = checkIndex($data, "contact_name_old");
    // compareName($contact, $contact_name_old, $contact->contact_name);
    $query = checkUpdate($contact);
    returnSuccess($contact, "contact", $query);
}

checkEndpoint();