<html>

<head>
    <link rel="stylesheet" href="style.php">
</head>

<body>
    <h2>Park Administrator View</h2>
    <h3>Show Tables</h3>
    <div class="admin_table_buttons">
        <form method="GET" action="outdoor-db.php">
            <input type="hidden" id="showPersonTable" name="showPersonTable">
            <input class="table_button" type="submit" value="Persons" name="showPersonTable"></p>
        </form>

        <form method="GET" action="outdoor-db.php">
            <input type="hidden" id="showHikerTable" name="showHikerTable">
            <input class="table_button" type="submit" value="Hikers" name="showHikerTable"></p>
        </form>

        <form method="GET" action="outdoor-db.php">
            <input type="hidden" id="showCamperTable" name="showCamperTable">
            <input class="table_button" type="submit" value="Campers" name="showCamperTable"></p>
        </form>

        <form method="POST" action="outdoor-db.php">
            <input type="hidden" id="show-campground-table" name="show-campground-table">
            <input class="table_button" type="submit" value="Campgrounds" name="show-campground-table"></p>
        </form>

        <form method="POST" action="outdoor-db.php">
            <input type="hidden" id="show-person-table" name="show-person-table">
            <input class="table_button" type="submit" value="People" name="show-person-table"></p>
        </form>

    </div>

    <?php

    function showPersonTable()
    {
        $result = executePlainSQL("SELECT * FROM person");
        printPerson($result);
    }

    function showHikerTable()
    {
        $result = executePlainSQL("SELECT * FROM hiker");
        printHikers($result);
    }

    function showCamperTable()
    {
        $result = executePlainSQL("SELECT * FROM camper");
        printCampers($result);
    }

    function printPerson($result)
    { //prints results from a select statement
        echo "<table class=admin_table>";
        echo "<caption style='text-align:center'>Person Table</caption>";
        echo "<tr><th>SIN</th><th>Name</th><th>Age</th></tr>";

        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            echo "<tr><td>" . $row["SINNUM"] . "</td><td>" . $row["PERSONNAME"] . "</td><td>" . $row["PERSONAGE"] . "</td></tr>";
        }

        echo "</table>";
    }

    function printHikers($result)
    {
        echo "<table class=admin_table>";
        echo "<caption style='text-align:center'>Hiker Table</caption>";
        echo "<tr><th>Name</th><th>ExperienceLevel</th><th>FirstAidCert</th></tr>";

        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            echo "<tr><td>" . $row["SINNUM"] . "</td><td>" . $row["EXPERIENCELEVEL"] . "</td><td>" . $row["FIRSTAIDCERT"] . "</td></tr>";
        }

        echo "</table>";
    }

    function printCampers($result)
    {
        echo "<table class=admin_table>";
        echo "<caption style='text-align:center'>Camper Table</caption>";
        echo "<tr><th>Name</th><th>ShelterType</th></tr>";

        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            echo "<tr><td>" . $row["SINNUM"] . "</td><td>" . $row["SHELTERTYPE"] . "</td></tr>";
        }

        echo "</table>";
    }

    ?>
</body>

</html>