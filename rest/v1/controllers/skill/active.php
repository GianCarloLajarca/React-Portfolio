<?php
require '../../core/header.php';
require '../../core/functions.php';
require '../../models/Skill.php';

$conn = null;
$conn = checkDbConnection();

$skill = new Skill($conn);

$body = file_get_contents("php://input");
$data = json_decode($body, true);


if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    checkApiKey();
    if (array_key_exists("skillid", $_GET)) {

        checkPayload($data);
        $skill->skill_aid = $_GET['skillid'];
        $skill->skill_is_active = trim($data["isActive"]);
        $skill->skill_datetime = date("Y-m-d H:i:s");
        checkId($skill->skill_aid);
        $query = checkActive($skill);
        http_response_code(200);
        returnSuccess($skill, "skill", $query);
    }
    checkEndpoint();
}

http_response_code(200);
// header('HTTP/1.0 401 Unauthorized');
checkAccess();