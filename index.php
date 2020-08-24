<?php

    $todos = [];
    if(file_exists('todo.json'))
    {
        $json = file_get_contents('todo.json');
        $todos = json_decode($json, true);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Document</title>
</head>
<body>
    
    <div class="main">
        <form action="newtodo.php" method="post">
            <input type="text" name="todo_name" id="Insert_todo" class="txtInput" autofocus>
            <button class="btn new">New todo</button>
        </form>

        <?php
            foreach($todos as $todoName => $todo) : ?>
            <div class="list">
                <div class="listItem">
                    <form action="change_status.php" method="post">
                        <input type="hidden" name="todo_name" method="post" value="<?php echo $todoName ?>">
                        <input type="checkbox" <?php echo $todo['completed'] ? 'checked' : '' ?> >
                    </form>
                        
                    <?php echo $todoName?>
                    <form action="delete.php" method="post">
                        <input type="hidden" name="todo_name" value="<?php echo $todoName ?>">
                        <button class="btn">Delete</button>
                    </form>
                </div>  
            </div>
        <?php endforeach; ?>
    </div>
    
    <script>
        const checkboxes = document.querySelectorAll('input[type=checkbox]');
        checkboxes.forEach(ch => {
            ch.onclick = function () {
                this.parentNode.submit();
            };
        })
    </script>
</body>
</html>