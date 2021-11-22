<html>
<form method="POST" action="outdoor-db.php">
    <input type="hidden" id="hikingtrip-agg" name="hikingtrip-agg">
    <input type="submit" value="Group By: Trailname, Find Hiking Trips with Duration <= Trail Avg" name="hikingtrip-agg"></p>
</form>
</form>
<?php
function nestedAggregation()
{
    $result = executePlainSql("SELECT h.hikingTripId, h.trailname
                FROM HikingTrip h
                WHERE h.duration <= all(SELECT avg(h2.duration)
                                        FROM HikingTrip h2
                                        WHERE h.trailname = h2.trailname
                                        GROUP BY trailname)");
    $selections = array("HIKINGTRIPID", "TRAILNAME");
    printGenericTable($result, $selections, 2, "hikingtrip");
}
?>

</html>