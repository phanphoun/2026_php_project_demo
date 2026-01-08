<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo list app</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Todo list app</h1>

    <?php
    try {
        // define database connection
        define("USERNAME", "root");
        define("DBNAME", "todo_list");
        define("DB_PWD", "");
        define("DB_SERVER", "localhost");
        // create connection string
        $conn_state = "mysql:host=" . DB_SERVER . ";dbname=" . DBNAME;
        // create connection
        $conn = new PDO($conn_state, USERNAME, "");
        // set error mode
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Database connected success fully.";


    } catch (PDOException $error) {
        // print error message
        echo "Connection failed: " . $error->getMessage();
    }

    // ==========================================
    // get all tasks from database
    $sql = "SELECT * FROM tasks";
    // prepare the query
    $stmt = $conn->prepare($sql);
    // execute the query
    $stmt->execute();
    // fetch all data from database
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // alternative way to print array
    // var_dump($tasks);
    // echo "<pre>";
    // print_r($tasks);
    // echo "</pre>";
    foreach ($tasks as $task) {
        // if (isset($task['completed']) && $task['completed'] !== null) {
        //     echo htmlspecialchars($task['completed']) . "<br>";
        // } else {
        //     echo "Task with no completion status<br>";
        // }
    }
    ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Task</th>
                <th>Description</th>
                <th>Completed</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($task['id'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($task['task'] ?? 'No task'); ?></td>
                    <td><?php echo htmlspecialchars($task['description'] ?? 'No description'); ?></td>
                    <td><?php echo htmlspecialchars($task['completed'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($task['created_at'] ?? 'N/A'); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>