<?php
$conn = null;
$conn = checkDbConnection();
$project = new Project($conn);
$error = [];
$returnData = [];
if (array_key_exists("projectid", $_GET)) {
    checkPayload($data);
    $project->project_aid = $_GET['projectid'];
    $project->project_title = checkIndex($data, "project_title");
    $project->project_thumbnail = checkIndex($data, "project_thumbnail");
    $project->project_image_1 = checkIndex($data, "project_image_1");
    $project->project_image_2 = checkIndex($data, "project_image_2");
    $project->project_image_3 = checkIndex($data, "project_image_3");
    $project->project_image_4 = checkIndex($data, "project_image_4");
    $project->project_image_5 = checkIndex($data, "project_image_5");
    $project->project_image_6 = checkIndex($data, "project_image_6");
    $project->project_category = checkIndex($data, "project_category");
    $project->project_description = checkIndex($data, "project_description");
    $project->project_button = checkIndex($data, "project_button");
    $project->project_publish_date = checkIndex($data, "project_publish_date");
    $project->project_datetime = date("Y-m-d H:i:s");
    
    checkId($project->project_aid);
    // $project_name_old = checkIndex($data, "project_name_old");
    // compareName($project, $project_name_old, $project->project_name);
    $query = checkUpdate($project);
    returnSuccess($project, "project", $query);
}

checkEndpoint();