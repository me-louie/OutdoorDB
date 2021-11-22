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
        include 'park-user-delete.php';
        ?>
    </section>
    <section class="view">
        <?php
        include 'park-admin.php';
        include 'camp-aggregation.php';
        include 'aggregation_having.php';
        include 'hikingtrip-aggregation.php';
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
               /** handle any GET requests */
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
                if (array_key_exists('campground-agg', $_POST)) {
                    groupBy();
                }
                if (array_key_exists('campground-agg-having', $_POST)) {
                    byHaving();
                }
                if (array_key_exists('hikingtrip-agg', $_POST)){
                    nestedAggregation();
                }
                if (array_key_exists('division-sin', $_POST)) {
                    handleDivision($_POST["division-sin"]);
                }
                if (array_key_exists('show-person-table', $_POST)) {
                    handleShowGenericTable(PERSON_RENAME_MAP, PERSON_RENAME_ASMAP, "person", PERSON_PERSISTENT_COLS);
                }
                if (array_key_exists('show-hike-table', $_POST)) {
                    handleShowGenericTable(HIKE_RENAME_MAP, HIKE_RENAME_ASMAP, "hike", HIKE_PERSISTENT_COLS);
                }
                if (array_key_exists('show-hikingtrip-table', $_POST)) {
                    handleShowGenericTable(HIKINGTRIP_RENAME_MAP, HIKINGTRIP_RENAME_ASMAP, "hikingtrip", HIKINGTRIP_PERSISTENT_COLS);
                }
                if (array_key_exists('show-reservation-table', $_POST)) {
                    handleShowGenericTable(RESERVATION_RENAME_MAP, RESERVATION_RENAME_ASMAP, "reservation", RESERVATION_PERSISTENT_COLS);
                }
                if (array_key_exists('show-park-table', $_POST)) {
                    handleShowGenericTable(PARK_RENAME_MAP, PARK_RENAME_ASMAP, "park", PARK_PERSISTENT_COLS);
                }
                if (array_key_exists('show-provincialpark-table', $_POST)) {
                    handleShowGenericTable(PROV_RENAME_MAP, PROV_RENAME_ASMAP, "provincialpark", PROV_PERSISTENT_COLS);
                }
                if (array_key_exists('show-nationalpark-table', $_POST)) {
                    handleShowGenericTable(NAT_RENAME_MAP, NAT_RENAME_ASMAP, "nationalpark", NAT_PERSISTENT_COLS);
                }
                if (array_key_exists('show-camper-table', $_POST)) {
                    handleShowGenericTable(CAMPER_RENAME_MAP, CAMPER_RENAME_ASMAP, "camper", CAMPER_PERSISTENT_COLS);
                }
                if (array_key_exists('show-hiker-table', $_POST)) {
                    handleShowGenericTable(HIKER_RENAME_MAP, HIKER_RENAME_ASMAP, "hiker", HIKER_PERSISTENT_COLS);
                }
                if (array_key_exists('show-viewpoint-table', $_POST)) {
                    handleShowGenericTable(VIEWPOINT_RENAME_MAP, VIEWPOINT_RENAME_ASMAP, "viewpoint", VIEWPOINT_PERSISTENT_COLS);
                }
                if (array_key_exists('show-lake-table', $_POST)) {
                    handleShowGenericTable(LAKE_RENAME_MAP, LAKE_RENAME_ASMAP, "lake", LAKE_PERSISTENT_COLS);
                }
                if (array_key_exists('show-daytrip-table', $_POST)) {
                    handleShowGenericTable(DAYTRIP_RENAME_MAP, DAYTRIP_RENAME_ASMAP, "daytrip", DAYTRIP_PERSISTENT_COLS);
                }
                if (array_key_exists('update-sin', $_POST)) {
                    handleUpdateUserRequest();
                }
                if (array_key_exists('delete-sin', $_POST)) {
                    handleDeleteUserRequest();
                }
                disconnectFromDB();
            }
        }

        if (
            isset($_POST['add-user-submit'])
            || isset($_POST['show-campground-table'])
            || isset($_POST['show-person-table'])
            || isset($_POST['show-hike-table'])
            || isset($_POST['show-hikingtrip-table'])
            || isset($_POST['show-reservation-table'])
            || isset($_POST['show-park-table'])
            || isset($_POST['show-provincialpark-table'])
            || isset($_POST['show-nationalpark-table'])
            || isset($_POST['show-camper-table'])
            || isset($_POST['show-hiker-table'])
            || isset($_POST['show-viewpoint-table'])
            || isset($_POST['show-lake-table'])
            || isset($_POST['show-daytrip-table'])
            || isset($_POST['update-user-submit'])
            || isset($_POST['delete-user-submit'])
            || isset($_POST['division-user-submit'])
            || isset($_POST['campground-agg'])
            || isset($_POST['campground-agg-having'])
            || isset($_POST['hikingtrip-agg'])
        ) {
            handlePOSTRequest();
        } else if (false) { // stub 
            handleGETRequest();
        }
        ?>
    </section>
</body>

</html>