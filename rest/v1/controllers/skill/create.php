<?php
$conn = null;
$conn = checkDbConnection();
$skill = new Skill($conn);
if (array_key_exists("skillid", $_GET)) {
    checkEndpoint();
}
checkPayload($data);
$skill->skill_title = checkIndex($data, "skill_title");
$skill->skill_photo = checkIndex($data, "skill_photo");
$skill->skill_is_active = 1;
$skill->skill_publish_date = checkIndex($data, "skill_publish_date");
$skill->skill_description = checkIndex($data, "skill_description");
$skill->skill_created = date("Y-m-d H:i:s");
$skill->skill_datetime = date("Y-m-d H:i:s");

// isNameExist($skill, $skill->skill_title);

$query = checkCreate($skill);
returnSuccess($skill, "skill", $query);