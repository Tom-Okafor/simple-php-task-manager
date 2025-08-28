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
            <form action="" method="POST">
                <div class="input-block">
                    <label for="task">Task Name</label>
                    <input type="text" name="task" id="task" placeholder="Enter your task name here..." required>
                </div>
                <div class="priority">
                    <h4>Task Priority</h4>
                    <input type="radio" name="priority" id="priority-lax" value="priority-lax" required>
                    <label for="priority-lax">Lax</label>
                    <input type="radio" name="priority" id="priority-important" value="priority-important" required>
                    <label for="priority-important">Important</label>
                    <input type="radio" name="priority" id="priority-urgent" value="priority-urgent" required>
                    <label for="priority-urgent">Urgent</label>

                </div>
                <div class="input-block">
                    <label for="description">Task Description</label>
                    <textarea name="description" id="description" placeholder="Enter the task description"></textarea>
                </div>
                <button type="submit" name="submit_task">Add Task</button>
            </form>
        </section>

        <section class="task-list">
            <?php if (isset($task_data) && !empty($task_data)) {?>
            <table cellspacing="0">
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
                    <tr>
                        <td>1</td>
                        <td>Clean The Kitchen</td>
                        <td>Take out the garbage. Wash the plates and pots. Clean the walls and unclutter the sink</td>
                        <td><span class="lax">Lax</span></td>
                        <td><span class="complete">Complete</span></td>
                        <td>
                            <a href="#" class="update-item"><img src="./assets/edit-4-svgrepo-com.svg" alt="update"/></a>
                            <a href="#" class="delete-item"><img src="./assets/delete-2-svgrepo-com.svg" alt="delete" /></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Paint the walls</td>
                        <td>Lorem Ipsum dolor ipsum cum laude if no bettear sind carliever dorias echag shoeli iproxi delium</td>
                        <td><span class="urgent">Urgent</span></td>
                        <td><span class="incomplete">Incomplete</span></td>
                        <td>
                            <a href="#" class="update-item"><img src="./assets/edit-4-svgrepo-com.svg" alt="update" /></a>
                            <a href="#" class="delete-item"><img src="./assets/delete-2-svgrepo-com.svg" alt="delete" /></a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Arrange the Sitting room</td>
                        <td>Take out the garbage. Wash the plates and pots. Clean the walls and unclutter the sink</td>
                        <td><span class="important">Important</span></td>
                        <td><span class="inprogress">In progress</span></td>
                        <td>
                            <a href="#" class="update-item"><img src="./assets/edit-4-svgrepo-com.svg" alt="update" /></a>
                            <a href="#" class="delete-item"><img src="./assets/delete-2-svgrepo-com.svg" alt="delete" /></a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php } else {
                echo '<h3 class="task-list-error">No tasks to display. Please add a new task!</h3>';
            }?>
        </section>
    </main>
    <footer></footer>

</body>

</html>