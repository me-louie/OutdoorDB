<html>
        <form method="POST" action="outdoor-db.php">
            <input type="hidden" id="campground-agg" name="campground-agg">
            <input type="submit" value="Group By: CampType, Sum NumWaterSources > 4" name="campground-agg"></p>
        </form>
<?php
	function groupBy() {
    $result = executePlainSql("SELECT c.campType as campType, sum(wt.numWaterSources) as numWaterSources
                FROM campground c 
                INNER JOIN campgroundtype ct ON c.camptype=ct.camptype
                INNER JOIN waterToilets wt
                ON c.numWaterSources=wt.numWaterSources
                INNER JOIN toiletsShowers ts
                ON wt.numToilets=ts.numToilets
                WHERE wt.numWaterSources > 4
                GROUP BY c.campType");
    $selections = array("CAMPTYPE","NUMWATERSOURCES");
    printGenericTable($result, $selections, 2, "campground");
}
?>
</html>


