<?php


function processTaskSubmission()
{
    session_start();
    if (!($_SERVER['REQUEST_METHOD'] == 'POST')) {
        return;
    }

    if (!isset($_SESSION['task_data'])) {
        $_SESSION['task_data'] = [];
    }

    $task_name = $_POST['task_name'];
    $task_priority = $_POST['task_priority'];
    $task_description = $_POST['task_description'];
    if (empty($task_name) || empty($task_priority) || empty($task_description)) {
        $task_data_input_error = true;
        return;
    }
    array_push($_SESSION['task_data'], [
        "task_id" => count($_SESSION['task_data']) + 1,
        "task_name" => $task_name,
        "task_description" => $task_description,
        "task_priority" => $task_priority,
        "task_status" => 'incomplete' ]);

    header('Location: index.php');
}

function processTaskData()
{
    if (!$_SESSION['task_data']) {
        return;
    }
    $task_data = $_SESSION['task_data'];
    if (isset($_GET['filter'])) {
    }
    return $task_data;
}
processTaskSubmission();
