<html>

<head>

<body>
    <h2>User View</h2>
    <h3>Create a new account:</h3>

    <form method="POST" action="outdoor-db.php">
        <input type="hidden" id="insertNewUser" name="insertNewUser">
        SIN Number: <input type="number" name="insNo"> <br /><br />
        Name: <input type="text" name="insName"> <br /><br />
        Age: <input type="number" name="insAge"> <br /><br />

        <input type="submit" value="Create" name="insertNewUserSubmit"></p>
    </form>

    <?php

    function handleInsertUserRequest()
    {
        global $db_conn;
        //Getting the values from user and insert data into the table
        $tuple = array(
            ":bind1" => $_POST['insNo'],
            ":bind2" => $_POST['insName'],
            ":bind3" => $_POST['insAge']
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