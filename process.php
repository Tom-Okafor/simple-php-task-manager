<?php

function processTaskSubmission()
{
    session_start();

    if (!isset($_POST['task_name']) || !isset($_POST['task_priority']) || !isset($_POST['task_description'])) {
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

    if (isset($_GET['sort']) && isset($_GET['sort-order'])) {
        $selected_sort = $_GET['sort'];
        $selected_sort_order = $_GET['sort-order'];
        $sorted_tasks = $task_data;


        if ($selected_sort_order === 'ascending') {
            switch ($selected_sort) {
                case 'sort_name':
                    return   sortTasks($sorted_tasks, 'task_name');
                case 'sort_priority':
                    return  sortTasks($sorted_tasks, 'task_priority');
                case 'sort_id':
                    return sortTasks($sorted_tasks, 'task_id');

            }

        }


        if ($selected_sort_order === 'descending') {

            switch ($selected_sort) {
                case 'sort_name':
                    return    sortTasksDescending($sorted_tasks, 'task_name');
                case 'sort_priority':
                    return  sortTasksDescending($sorted_tasks, 'task_priority');

                case 'sort_id':
                    return   sortTasksDescending($sorted_tasks, 'task_id');
            }
            return $sorted_tasks;

        }




    }
    return $task_data;
}

function sortTasks(array $data, string $category)
{
    if ($category === 'task_name') {


        usort($data, function ($a, $b) {
            return strcmp(strtoupper($a['task_name']), strtoupper($b['task_name']));
        });
    }
    if ($category === 'task_id') {
        usort($data, function ($a, $b) {
            return $a['task_id'] - $b['task_id'];
        });
    }
    if ($category === 'task_priority') {
        usort($data, function ($a, $b) {
            $first = match ($a['task_priority']) {
                'lax' => 'a',
                'important' => 'b',
                'urgent' => 'c'
            };
            $second = match ($b['task_priority']) {
                'lax' => 'a',
                'important' => 'b',
                'urgent' => 'c'
            };
            return  strcmp($first, $second);
        });
    }
    return $data;
}
function sortTasksDescending(array $data, string $category)
{
    if ($category === 'task_name') {
        usort($data, function ($a, $b) {

            return strcmp(strtoupper($b['task_name']), strtoupper($a['task_name']));
        });

    }
    if ($category === 'task_id') {
        usort($data, function ($a, $b) {
            return  $b['task_id'] - $a['task_id'];
        });
    }
    if ($category === 'task_priority') {
        usort($data, function ($a, $b) {
            $first = match ($a['task_priority']) {
                'lax' => 'a',
                'important' => 'b',
                'urgent' => 'c'
            };
            $second = match ($b['task_priority']) {
                'lax' => 'a',
                'important' => 'b',
                'urgent' => 'c'
            };
            return  strcmp($second, $first);
        });
    }
    return $data;
}

function getTableDataQueryOptions(string $option_value, string $option_category)
{
    if (!isset($_GET[$option_category]) || !($_GET[$option_category] === $option_value)) {
        return;
    }
    echo 'selected';

}

function checkForUpdateId()
{
    return  isset($_GET['update-id']) ? true : false;
}

function getUpdateIdTaskDetails()
{
    if (!isset($_GET['update-id'])) {
        return;
    }

    $update_id = $_GET['update-id'];
    $task_data = $_SESSION['task_data'];
    $update_details = array_filter($task_data, function ($each_task) use ($update_id) {
        return $each_task['task_id'] == $update_id;
    });
    if (!$update_details) {
        return;
    }
    return $update_details[array_keys($update_details)[0]];
}

function checkForUpdateTaskPriority(array $update_data, string $priority)
{
    if ($update_data['task_priority'] === $priority) {
        echo 'checked';
    }
}

function checkForUpdateTaskStatus(array $update_data, string $status)
{

    if ($update_data['task_status'] === $status) {
        echo 'selected';
    }

}

processTaskSubmission();

$task_data = processTaskData();
$update_details = getUpdateIdTaskDetails();
