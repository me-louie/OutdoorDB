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
            <input type="hidden" id="showCampgroundTable" name="showCampgroundTable">
            <input class="table_button" type="submit" value="Campgrounds" name="showCampgroundTable"></p>
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

    function handleShowCampgroundTable()
    {
        $selections = isset($_POST['campgroundAmentities']) ? $_POST['campgroundAmentities'] : '';
        if (empty($selections)) {
            $selections
                = ["CAMPTYPE", "NUMWATERSOURCES", "NUMSITES", "NUMTOILETS", "NUMSHOWERS", "DOGSALLOWED"];
        }
        $N = count($selections);
        // Get the first selection because so we can append subsequent selections with the comma
        $selectString = getCampgroundTableProjectionStatement($selections[0]);
        for ($i = 1; $i < $N; $i++) {
            $selectString .= ", " . getCampgroundTableProjectionStatement($selections[$i]);
        }

        $result = executePlainSQL(
            "SELECT campgroundName, coords, $selectString 
                FROM campground c 
                INNER JOIN campgroundtype ct ON c.camptype=ct.camptype
                INNER JOIN waterToilets wt
                ON c.numWaterSources=wt.numWaterSources
                INNER JOIN toiletsShowers ts
                ON wt.numToilets=ts.numToilets"
        );
        printCampgroundTable($result, $selections, $N);
    }

    function getCampgroundTableProjectionStatement($select)
    {
        switch ($select) {
            case "CAMPTYPE":
                return "c.campType as campType";
            case "NUMWATERSOURCES":
                return "c.numWaterSources as numWaterSources";
            case "DOGSALLOWED":
                return "ct.dogsAllowed as dogsAllowed";
            case "NUMSITES":
                return "ct.numSites as numSites";
            case "NUMTOILETS":
                return "wt.numToilets as numToilets";
            case "NUMSHOWERS":
                return "ts.numShowers as numShowers";
        }
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

    function printCampgroundFilters()
    {
        echo "<form action=outdoor-db.php method=post>
        <div class=filters>
        <input type=checkbox name=campgroundAmentities[] value=CAMPTYPE>Camp Type<br>
        <input type=checkbox name=campgroundAmentities[] value=NUMWATERSOURCES># of Water Sources<br>
        <input type=checkbox name=campgroundAmentities[] value=NUMSITES># of Sites<br>
        <input type=checkbox name=campgroundAmentities[] value=NUMTOILETS># of Toilets<br>
        <input type=checkbox name=campgroundAmentities[] value=NUMSHOWERS># of Showers<br>
        <input type=checkbox name=campgroundAmentities[] value=DOGSALLOWED>DogsAllowed<br>
        <input type=submit name=showCampgroundTable value=Filter>
        </div>        
        </form>";
    }

    function printCampgroundTable($result, $selections, $N)
    {
        printCampgroundFilters();
        echo "<table class=admin_table>";
        echo "<caption style='text-align:center'>Campgrounds</caption>";
        $headers = "<tr><td>CAMPGROUNDNAME</td><td>COORDS</td>";
        for ($i = 0; $i < $N; $i++) {
            $headers .= "<td>" . $selections[$i] . "</td>";
        }
        $headers .= "</tr>";
        echo $headers;
        $data = "<tr>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            // We always display the Campground Name and Coords columns
            $data .= "<tr><td>" . $row["CAMPGROUNDNAME"] . "</td><td>" . $row["COORDS"] . "</td>";
            // Display the other columns per user selection
            for ($i = 0; $i < $N; $i++) {
                $data .= "<td>" . $row[$selections[$i]] . "</td>";
            }
            $data .= "</tr>";
        }

        echo $data;
        echo "</table>";
    }
    ?>
</body>

</html>