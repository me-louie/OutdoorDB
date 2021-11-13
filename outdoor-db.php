<html>

<head>
    <title>Outdoor Database</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
</head>
<!-- <nav>
    <a href="park-admin.php">Admin Portal</a>
    <a href="park-user.php">User Portal</a>
</nav> -->

<body>
    <section class="view">
        <?php
        include 'park-user.php';
        include 'park-user-update.php';
        ?>
    </section>
    <section class="view">
        <?php
        include 'park-admin.php';
        require("generic-table-selection.php");
        require("constants.php");


        error_reporting(-1);
        ini_set('display_errors', 1);
        //this tells the system that it's no longer just parsing html; it's now parsing PHP

        $success = True; //keep track of errors so it redirects the page only if there are no errors
        $db_conn = NULL; // edit the login credentials in connectToDB()
        $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())

        function debugAlertMessage($message)
        {
            global $show_debug_alert_messages;

            if ($show_debug_alert_messages) {
                echo "<script type='text/javascript'>alert('" . $message . "');</script>";
            }
        }

        function executePlainSQL($cmdstr)
        { //takes a plain (no bound variables) SQL command and executes it
            //echo "<br>running ".$cmdstr."<br>";
            global $db_conn, $success;

            $statement = OCIParse($db_conn, $cmdstr);
            //There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work

            if (!$statement) {
                echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
                $e = OCI_Error($db_conn); // For OCIParse errors pass the connection handle
                echo htmlentities($e['message']);
                $success = False;
            }

            $r = OCIExecute($statement, OCI_DEFAULT);
            if (!$r) {
                echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
                $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
                echo htmlentities($e['message']);
                $success = False;
            }

            return $statement;
        }

        function executeBoundSQL($cmdstr, $list)
        {
            /* Sometimes the same statement will be executed several times with different values for the variables involved in the query.
                In this case you don't need to create the statement several times. Bound variables cause a statement to only be
                parsed once and you can reuse the statement. This is also very useful in protecting against SQL injection. 
                See the sample code below for how this function is used */

            global $db_conn, $success;
            $statement = OCIParse($db_conn, $cmdstr);

            if (!$statement) {
                echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
                $e = OCI_Error($db_conn);
                echo htmlentities($e['message']);
                $success = False;
            }

            foreach ($list as $tuple) {
                foreach ($tuple as $bind => $val) {
                    //echo $val;
                    //echo "<br>".$bind."<br>";
                    OCIBindByName($statement, $bind, $val);
                    unset($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
                }

                $r = OCIExecute($statement, OCI_DEFAULT);
                if (!$r) {
                    echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
                    $e = OCI_Error($statement); // For OCIExecute errors, pass the statementhandle
                    echo htmlentities($e['message']);
                    echo "<br>";
                    $success = False;
                }
            }
        }

        function connectToDB()
        {
            global $db_conn;

            // Your username is ora_(CWL_ID) and the password is a(student number). For example, 
            // ora_platypus is the username and a12345678 is the password.
            $db_conn = OCILogon("ora_melouie", "a67247544", "dbhost.students.cs.ubc.ca:1522/stu");

            if ($db_conn) {
                debugAlertMessage("Database is Connected");
                return true;
            } else {
                debugAlertMessage("Cannot connect to Database");
                $e = OCI_Error(); // For OCILogon errors pass no handle
                echo htmlentities($e['message']);
                return false;
            }
        }

        function disconnectFromDB()
        {
            global $db_conn;

            debugAlertMessage("Disconnect from Database");
            OCILogoff($db_conn);
        }

        function handleGETRequest()
        {
            if (connectToDB()) {
                if (array_key_exists('showPersonTable', $_GET)) {
                    showPersonTable();
                }

                if (array_key_exists('showHikerTable', $_GET)) {
                    showHikerTable();
                }

                if (array_key_exists('showCamperTable', $_GET)) {
                    showCamperTable();
                }

                disconnectFromDB();
            }
        }

        function handlePOSTRequest()
        {
            if (connectToDB()) {
                if (array_key_exists('add-user', $_POST)) {
                    handleInsertUserRequest();
                }
                if (array_key_exists('show-campground-table', $_POST)) {
                    handleShowGenericTable(CAMPGROUND_RENAME_MAP, CAMPGROUND_RENAME_ASMAP, "campground", CAMPGROUND_PERSISTENT_COLS);
                }
                if (array_key_exists('show-person-table', $_POST)) {
                    handleShowGenericTable(PERSON_RENAME_MAP, PERSON_RENAME_ASMAP, "person", PERSON_PERSISTENT_COLS);
                }
                if (array_key_exists('show-hike-table', $_POST)) {
                    handleShowGenericTable(HIKE_RENAME_MAP, HIKE_RENAME_ASMAP, "hike", HIKE_PERSISTENT_COLS);
                }
                if (array_key_exists('update-sin', $_POST)) {
                    handleUpdateUserRequest();
                }
                disconnectFromDB();
            }
        }

        if (
            isset($_POST['add-user-submit'])
            || isset($_POST['show-campground-table'])
            || isset($_POST['show-person-table'])
            || isset($_POST['show-hike-table'])
            || isset($_POST['update-user-submit'])
        ) {
            handlePOSTRequest();
        } else if (
            isset($_GET['showPersonTable'])
            || isset($_GET['showHikerTable'])
            || isset($_GET['showCamperTable'])
        ) {
            handleGETRequest();
        }
        ?>
    </section>
</body>

</html>