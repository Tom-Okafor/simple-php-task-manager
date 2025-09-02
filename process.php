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
        if ($_GET['filter'] === '') {
            header('Location: index.php');
        }
        $selected_filter = $_GET['filter'];

        $filtered_tasks = match ($selected_filter) {
            'urgent' => array_filter($task_data, function ($task_item) {
                return $task_item['task_priority'] === 'urgent';
            }),
            'important' => array_filter($task_data, function ($task_item) {
                return $task_item['task_priority'] === 'important';
            }),
            'lax' => array_filter($task_data, function ($task_item) {
                return $task_item['task_priority'] === 'lax';
            }),
            'incomplete' => array_filter($task_data, function ($task_item) {
                return $task_item['task_status'] === 'incomplete';
            }),
            'complete' => array_filter($task_data, function ($task_item) {
                return $task_item['task_status'] === 'complete';
            }),
            'progress' => array_filter($task_data, function ($task_item) {
                return $task_item['task_status'] === 'progress';
            }),
            default => $task_data,
        };
        return $filtered_tasks;
    }
    return $task_data;
}

function chooseSelectedFilter(string $filter_value)
{
    if (isset($_GET['filter']) && $_GET['filter'] === $filter_value) {
        echo "selected";
    }
}
processTaskSubmission();
