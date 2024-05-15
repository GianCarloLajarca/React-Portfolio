<?php
$conn = null;
$conn = checkDbConnection();
$skill = new Skill($conn);

$error = [];
$returnData = [];
if (array_key_exists("skillid", $_GET)) {
    $skill->skill_aid = $_GET['skillid'];
    checkId($skill->skill_aid);

    $query = checkDelete($skill);
    returnSuccess($skill, "skill", $query);
}

checkEndpoint();