<?php
include 'process.php';
$task_data = processTaskData();
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
                    <option value="all">All</option>
                    <option value="urgent">Urgent</option>
                    <option value="important">Important</option>
                    <option value="lax">Lax</option>
                    <option value="complete">Completed</option>
                    <option value="progress">In Progress</option>
                    <option value="incomplete">Incomplete</option>
                </select>
            </form>

            <form action="" method="post" id="sort-form">
                <div class="sort-options">
                    <label for="sort">Sort Tasks</label>
                <select name="sort" id="sort">
                    <option value="">sort by</option>
                    <option value="sort_name">name</option>
                    <option value="sort_priority">priority</option>
                    <option value="sort_id">S/N</option>
                </select>
                </div>

                <div class="sort-order-options">
                <label for="sort-order">Sort Order</label>
                <select name="sort-order" id="sort-order">
                    <option value="ascending">ascending</option>
                    <option value="descending">descending</option>
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
                            <a href="#" class="update-item" data-task_id='.$task_item['task_id'].'><img src="./assets/edit-4-svgrepo-com.svg" alt="update"/></a>
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
    <footer></footer>

    <script src="./app.js"></script>
</body>

</html>