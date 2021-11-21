<html>
        <form method="POST" action="outdoor-db.php">
            <input type="hidden" id="campground-agg-having" name="campground-agg-having">
            <input type="submit" value="By Having: CampType, with COUNT > 1 for numToilets" name="campground-agg-having"></p>
        </form>
    </form>
<?php
	function byHaving() {
    $result = executePlainSql("SELECT c.campType as campType, sum(wt.numToilets) as numToilets
        FROM campground c 
        INNER JOIN campgroundtype ct ON c.camptype=ct.camptype
        INNER JOIN waterToilets wt
        ON c.numWaterSources=wt.numWaterSources
        INNER JOIN toiletsShowers ts
        ON wt.numToilets=ts.numToilets
        WHERE wt.numToilets > 5
        GROUP BY c.campType
        HAVING COUNT(*) > 1");
    $selections = array("CAMPTYPE","NUMTOILETS");
    printGenericTable($result, $selections, 2, "campground");
}
?>
</html>