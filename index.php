<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900&amp;family=Plus+Jakarta+Sans%3Awght%40400%3B500%3B700%3B800"
    />

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
                <input type="text" name="task" id="task" placeholder="Enter your task here..." required>
                <div class="priority">
                    <h4>Task Priority</h4>
                    <input type="radio" name="priority" id="priority-lax" value="priority-lax">
                    <label for="priority-lax">Lax</label>
                    <input type="radio" name="priority" id="priority-important" value="priority-important">
                    <label for="priority-important">Important</label>
                    <input type="radio" name="priority" id="priority-" value="priority-urgent">
                    <label for="priority-lax">Ugent</label>
                    
                </div>
                <input type="text" name="description" id="description" placeholder="Enter task description..." required>
                <button type="submit">Add Task</button>
            </form>
        </section>
    </main>
    <footer></footer>
    
</body>
</html>