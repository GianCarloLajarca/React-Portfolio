<?php
$conn = null;
$conn = checkDbConnection();
$skill = new Skill($conn);
$error = [];
$returnData = [];
if (array_key_exists("skillid", $_GET)) {
    checkPayload($data);
    $skill->skill_aid = $_GET['skillid'];
    $skill->skill_title = checkIndex($data, "skill_title");
    $skill->skill_photo = checkIndex($data, "skill_photo");
    $skill->skill_description = checkIndex($data, "skill_description");
    $skill->skill_publish_date = checkIndex($data, "skill_publish_date");
    $skill->skill_datetime = date("Y-m-d H:i:s");
    
    checkId($skill->skill_aid);
    // $skill_name_old = checkIndex($data, "skill_name_old");
    // compareName($skill, $skill_name_old, $skill->skill_name);
    $query = checkUpdate($skill);
    returnSuccess($skill, "skill", $query);
}

checkEndpoint();