<html>

<head>

<body>
    <h2>User View</h2>
    <h3>Create a new account:</h3>

    <form method="POST" action="outdoor-db.php" class="add_user_box">
        <section class="input_container">
            <input type="hidden" id="add-user" name="add-user">
            <div>
                <label for ="sin"> SIN </label>
                <input class="field" type="number" id="sin" name="sin">
            </div>
            <div>
                <label for ="name"> Name </label>
                <input class="field" type="text" id="name" name="name">
            </div>
            <div>
                <label for ="age"> Age </label>
                <input class="field" type="number" id="age" name="age">
            </div>
        </section>
        <input class="create_button" type="submit" value="Create" name="add-user-submit">
    </form>

    <?php

    function handleInsertUserRequest()
    {
        global $db_conn;
        //Getting the values from user and insert data into the table
        $tuple = array(
            ":bind1" => $_POST['sin'],
            ":bind2" => $_POST['name'],
            ":bind3" => $_POST['age']
        );

        $alltuples = array(
            $tuple
        );

        executeBoundSQL("insert into person values (:bind1, :bind3, :bind2)", $alltuples);
        OCICommit($db_conn);
    }
    ?>

</body>
</head>

</html>