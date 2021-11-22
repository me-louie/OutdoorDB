
<section class="input_container_update">
    <form method="POST" action="outdoor-db.php" name="division-query">
        <div>
            <label for ="division-sin"> SIN </label>
            <input class="field" type="number" id="division-sin" name="division-sin">
        </div>
        <input class="division_button" type="submit" value="Search" name="division-user-submit">
    </form>
</section>
<?php 
    function handleDivision($sin) {
        if (strlen($sin) > 0) {
            $result = executePlainSQL(
                "SELECT DISTINCT T.TRAILNAME
                FROM TRAILS T
                MINUS
                SELECT HT.TRAILNAME
                FROM HIKINGTRIP HT
                WHERE HT.SINNUM = $sin 
                "
            );
            $selections = array("TRAILNAME");
            printGenericTable($result, $selections, 1, "hike");
        } else {
            alert("SIN cannot be empty!");
        }
    }

    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }


?>