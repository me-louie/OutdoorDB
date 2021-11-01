<html>

<head>
    <link rel="stylesheet" href="style.php">
</head>

<body>
    <h2>Park Administrator View</h2>
    <div>
        <h3>Show Tables</h3>
        <form method="GET" action="outdoor-db.php">
            <input type="hidden" id="showPersonTable" name="showPersonTable">
            <input type="submit" value="Persons" name="showPersonTable"></p>
        </form>

        <form method="GET" action="outdoor-db.php">
            <input type="hidden" id="showHikerTable" name="showHikerTable">
            <input type="submit" value="Hikers" name="showHikerTable"></p>
        </form>

        <form method="GET" action="outdoor-db.php">
            <input type="hidden" id="showCamperTable" name="showCamperTable">
            <input type="submit" value="Campers" name="showCamperTable"></p>
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
        echo "<br>Persons Table:<br>";
        echo "<table>";
        echo "<tr><th>SIN</th><th>Name</th><th>Age</th></tr>";

        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            echo "<tr><td>" . $row["SINNUM"] . "</td><td>" . $row["PERSONNAME"] . "</td><td>" . $row["PERSONAGE"] . "</td></tr>";
        }

        echo "</table>";
    }

    function printHikers($result)
    {
        echo "<br>Hikers Table:<br>";
        echo "<table>";
        echo "<tr><th>Name</th><th>ExperienceLevel</th><th>FirstAidCert</th></tr>";

        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            echo "<tr><td>" . $row["SINNUM"] . "</td><td>" . $row["EXPERIENCELEVEL"] . "</td><td>" . $row["FIRSTAIDCERT"] . "</td></tr>";
        }

        echo "</table>";
    }

    function printCampers($result)
    {
        echo "<br>Camper Table:<br>";
        echo "<table>";
        echo "<tr><th>Name</th><th>ShelterType</th></tr>";

        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            echo "<tr><td>" . $row["SINNUM"] . "</td><td>" . $row["SHELTERTYPE"] . "</td></tr>";
        }

        echo "</table>";
    }
    ?>
</body>

</html>