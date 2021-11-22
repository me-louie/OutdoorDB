<html>

<head>

<body>
    <h3>Delete User:</h3>

    <form method="POST" action="outdoor-db.php" class="add_user_box">
        <section class="input_container">
            <input type="hidden" id="delete-user" name="delete-user">
            <div>
                <label for ="sin"> SIN </label>
                <input class="field" type="number" id="delete-sin" name="delete-sin">
            </div>
        </section>
        <input class="delete_button" type="submit" value="Delete" name="delete-user-submit">
    </form>


    <?php

        /**
         * Execute the required DELETE ON CASCADE
         */
        function handleDeleteUserRequest()
        {
            global $db_conn;

            $cmdstr = "{$_POST['delete-sin']}";
            if (strlen($cmdstr) > 0) {
                executePlainSQL("DELETE FROM PERSON WHERE sinnum = $cmdstr");
            } else {
                require __DIR__ . '/park-user-division.php';
                echo alert("SIN cannot be empty!");
            }

            OCICommit($db_conn);
        }
    ?>

</body>
</head>

</html>
