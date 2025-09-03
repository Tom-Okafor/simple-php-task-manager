<?php
include 'process.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link rel="stylesheet" as="style" onload="this.rel='stylesheet'"
        href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900&amp;family=Plus+Jakarta+Sans%3Awght%40400%3B500%3B700%3B800" />

    <title>Task Manager</title>
</head>

<body>
    <header>
        <img src="./assets/hourglass-svgrepo-com.svg" alt="taskit logo">
        <span>TaskIt</span>
    </header>

    <main>
        <h1>Welcome to TaskIt</h1>
        <p>Plan and Organize your tasks and duties for increased productivity</p>
        <section class="task-input">
            <h3>Add New Task</h3>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="input-block">
                    <label for="task">Task Name</label>
                    <input type="text" name="task_name" id="task" placeholder="Enter your task name here..." required>
                </div>
                <div class="priority">
                    <h4>Task Priority</h4>
                    <input type="radio" name="task_priority" id="priority-lax" value="lax" required>
                    <label for="priority-lax">Lax</label>
                    <input type="radio" name="task_priority" id="priority-important" value="important" required>
                    <label for="priority-important">Important</label>
                    <input type="radio" name="task_priority" id="priority-urgent" value="urgent" required>
                    <label for="priority-urgent">Urgent</label>

                </div>
                <div class="input-block">
                    <label for="description">Task Description</label>
                    <textarea name="task_description" id="description" placeholder="Enter the task description"></textarea>
                </div>
                <button type="submit" name="submit_task">Add Task</button>
                
            <?php
            if (isset($task_data_input_error) && $task_data_input_error) {
                echo "<h2 class='task-list-error'>Please, ensure you enter data into all the fields. No task will be added if the all the form details are not provided</h2>";
            }
?>
            </form>
        </section>

        <section class="task-list">
            <div class="task-list-controls">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" id="filter-form">
                <label for="filter">Filter Tasks</label>
                <select name="filter" id="filter">
                    <option value="">filter by</option>
                    <option value="all" <?php getTableDataQueryOptions('all', 'filter') ?>>All</option>
                    <option value="urgent" <?php getTableDataQueryOptions('urgent', 'filter') ?>>Urgent</option>
                    <option value="important" <?php getTableDataQueryOptions('important', 'filter') ?>>Important</option>
                    <option value="lax" <?php getTableDataQueryOptions('lax', 'filter') ?>>Lax</option>
                    <option value="complete" <?php getTableDataQueryOptions('complete', 'filter') ?>>Completed</option>
                    <option value="progress" <?php getTableDataQueryOptions('progress', 'filter') ?>>In Progress</option>
                    <option value="incomplete" <?php getTableDataQueryOptions('incomplete', 'filter') ?>>Incomplete</option>
                </select>
            </form>

            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="GET" id="sort-form">
                <div class="sort-options">
                    <label for="sort">Sort Tasks</label>
                <select name="sort" id="sort">
                    <option value="">sort by</option>
                    <option value="sort_name" <?php getTableDataQueryOptions('sort_name', 'sort') ?>>name</option>
                    <option value="sort_priority" <?php getTableDataQueryOptions('sort_priority', 'sort') ?>>priority</option>
                    <option value="sort_id" <?php getTableDataQueryOptions('sort_id', 'sort') ?>>S/N</option>
                </select>
                </div>

                <div class="sort-order-options">
                <label for="sort-order">Sort Order</label>
                <select name="sort-order" id="sort-order">
                    <option value="ascending" <?php getTableDataQueryOptions('ascending', 'sort-order') ?>>ascending</option>
                    <option value="descending" <?php getTableDataQueryOptions('descending', 'sort-order') ?>>descending</option>
                </select></div>
            </form>
            </div>
            
            <?php if ($task_data && !empty($task_data)) {?>
            <table cellspacing="0" id="task-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Task Name</th>
                        <th>Task Description</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($task_data as $task_item) {
                        echo '<tr>
                        <td>'.$task_item["task_id"].'</td>
                        <td>'.$task_item["task_name"].'</td>
                        <td>'.$task_item["task_description"].'</td>
                        <td><span class='.$task_item["task_priority"].'>'.$task_item["task_priority"].'</span></td>
                        <td><span class='.$task_item["task_status"].'>'.$task_item["task_status"].'</span></td>';
                        if ($task_item["task_status"] == 'complete') {
                            echo '<td><span class="completed">Completed</span></td>';
                        } else {
                            echo '<td>
                            <a href="'.$_SERVER['PHP_SELF']."?update-id=".$task_item['task_id'].'" class="update-item" data-task_id='.$task_item['task_id'].'><img src="./assets/edit-4-svgrepo-com.svg" alt="update"/></a>
                            <a href="#" class="delete-item" data-task_id='.$task_item['task_id'].'><img src="./assets/delete-2-svgrepo-com.svg" alt="delete" /></a>
                        </td>
                        </tr>';
                        }
                    }

                ?>
                </tbody>
            </table>
            <?php } elseif (isset($_SESSION['task_data']) && !empty($_SESSION['task_data'])) {
                echo '<h3 class="task-list-error">No tasks to display in this category!</h3>';
            } else {

                echo '<h3 class="task-list-error">No tasks to display. Please add a new task!</h3>';

            }?>
            
        </section>
        
    </main>
        <section class="alert-container">
            <div class="task-add-alert">
            <img src="./assets/tick.svg" alt="" aria-hidden="true">
            <h3>Task Added Successfully!</h3>
        </div>
        </section>
    </main>
    <?php if ($update_details) :?>
        <section class="update-container <?php if (checkForUpdateId()) {
            echo 'visible';
        } ?>">
            <form action="<?php echo $_SERVER['PHP_SELF']."?updated_id=".$update_details['task_id']; ?>" method="POST" id="update-task-form">
                <div class="input-block">
                    <label for="task">Task Name</label>
                    <input type="text" name="update_task_name" id="task" value="<?php echo $update_details['task_name'] ?>" placeholder="Enter your new task name here..." required>
                </div>
                <div class="priority">
                    <h4>Task Priority</h4>
                    <input type="radio" name="update_task_priority" id="priority-lax" value="lax" <?php checkForUpdateTaskPriority($update_details, 'lax');?> required>
                    <label for="priority-lax">Lax</label>
                    <input type="radio" name="update_task_priority" id="priority-important" value="important" <?php checkForUpdateTaskPriority($update_details, 'important');?> required>
                    <label for="priority-important">Important</label>
                    <input type="radio" name="update_task_priority" id="priority-urgent" value="urgent" <?php checkForUpdateTaskPriority($update_details, 'urgent');?> required>
                    <label for="priority-urgent">Urgent</label>
                </div>
                <div class="input-block">
                    <label for="update_status">Task Status</label>
                    <select name="update_task_status" id="update_status">
                        <option value="incomplete" <?php checkForUpdateTaskStatus($update_details, 'incomplete')?>>Incomplete</option>
                        <option value="progress" <?php checkForUpdateTaskStatus($update_details, 'progress')?>>In Progress</option>
                        <option value="complete" <?php checkForUpdateTaskStatus($update_details, 'complete')?>>Complete</option>
                    </select>
                </div>
                <div class="input-block">
                    <label for="description">Task Description</label>
                    <textarea name="update_task_description" id="description"  placeholder="Enter the new task description"><?php echo $update_details['task_description']; ?></textarea>
                </div>
                <button type="submit" name="update_task">Update Task</button>
            </form>
        </section>
        <?php endif; ?>
    <footer></footer>

    <script src="./app.js"></script>
</body>

</html>