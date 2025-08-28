<?php

$task_data = [];
if (isset($_POST['submit_task'])) {
    $task_name = $_POST['task_name'];
    $task_priority = $_POST['task_priority'];
    $task_description = $_POST['task_description'];
    if (empty($task_name) || empty($task_priority) || empty($task_description)) {
        $task_data_input_error = true;
    }
}
