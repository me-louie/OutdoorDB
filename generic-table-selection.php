
<?php
require("constants.php");

function printGenericFilters(string $tablename, array $selectOptions, array $checkboxOptions)
{

    $select = ["<option disabled selected value> -- no selection -- </option>"];
    $checkbox = [];

    foreach($selectOptions as $option => $displayname) {
        array_push($select, "<option value=$option>$displayname</option>");
    }

    foreach($checkboxOptions as $option => $displayname) {
        array_push($checkbox, "<input type=checkbox name=$tablename-options[] value=$option checked>$displayname<br>");
    }

    $select = implode("\n", $select);
    $checkbox = implode("\n", $checkbox);

    echo "<form action=outdoor-db.php method=POST>
            <section class=input_container_update>
                <div>
                    <label for=$tablename-field> Field </label>
                    <select class=field id=$tablename-field name=$tablename-field>
                        $select
                    </select>
                </div>
                <div>
                    <label for=$tablename-select-operator> Operator </label>
                    <select class=field id=$tablename-select-operator name=$tablename-select-operator>
                        <option disabled selected value> -- no selection -- </option>
                        <option value='<'>Less Than</option>
                        <option value='='>Equal</option>
                        <option value='>'>Greater Than</option>
                    </select>
                </div>
                <div>
                    <label for=$tablename-select-value> Value </label>
                    <input class=field type=number id=$tablename-select-value name=$tablename-select-value>
                </div>
            </section>
            <div class=filters>
                $checkbox
                <input type=submit name=show-$tablename-table value=Filter>
            </div>        
    </form>";
}

function handleShowGenericTable($renameMap, $renameAsMap, $tablename, $constants)
{
    $whereString = "";
    if (
        isset($_POST["$tablename-field"])
        && isset($_POST["$tablename-select-operator"])
        && isset($_POST["$tablename-select-value"])
    ) {

        $field = $renameMap[$_POST["$tablename-field"]];
        $operator = $_POST["$tablename-select-operator"];
        $value = $_POST["$tablename-select-value"];
        $whereString = "WHERE " . $field . " " . $operator . " " . $value;
    }
    // PROJECTION
    $selections = isset($_POST["$tablename-options"]) ? $_POST["$tablename-options"] : [];
    $selections = array_merge($constants, $selections);
    $N = count($selections);

    $selectString = array_map(fn($entry) => $renameAsMap[$entry], $selections);
    $selectString = implode(",", $selectString);

    $result = executePlainSQL(sprintf(SELECT_SQL[$tablename], $selectString, $whereString));

    printGenericTable($result, $selections, $N, $tablename);
}


function printGenericTable($result, $selections, $N, $tablename) {
    printGenericFiltersDispatch($tablename);
    echo "<table class=admin_table>";
    echo "<caption style='text-align:center'>". strtoupper($tablename) . " TABLE </caption>";
    $headers = "<tr>";
    for ($i = 0; $i < $N; $i++) {
        $headers .= "<td>" . $selections[$i] . "</td>";
    }
    $headers .= "</tr>";
    echo $headers;

    $data = "<tr>";
    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
        $data .= "<tr>";
        for ($i = 0; $i < $N; $i++) {
            $data .= "<td>" . $row[$selections[$i]] . "</td>";
        }
        $data .= "</tr>";
    }

    echo $data;
    echo "</table>";
}

function printGenericFiltersDispatch(string $tablename)
{
    switch($tablename) {
        case "campground":
            printGenericFilters($tablename, CAMPGROUND_SELECT_OPTIONS, CAMPGROUND_CHECKBOX_OPTIONS);
            break;
        case "person":
            printGenericFilters($tablename, PERSON_SELECT_OPTIONS, PERSON_CHECKBOX_OPTIONS);
            break;
        case "hike":
            printGenericFilters($tablename, HIKE_SELECT_OPTIONS, HIKE_CHECKBOX_OPTIONS);
            break;
        default:
            echoFilterError();
            break;
    }
}

function echoFilterError() {
    echo "
        <section>
            <p> Unexpected error in filter dispatch. </p>
        </section>
    ";
}

?>