<?php 
    $person_map = array(
        "update-name" => "personname",
        "update-age" => "personage",
    );

    $hiker_map = array(
        "update-exp" => "experiencelevel",
        "update-first-aid" => "firstaidcert",
    );

    $camper_map = array(
        "update-shelter-type" => "sheltertype"
    )
?>

<html>
    <body>
        <h3>Update user information:</h3>
        <form method="POST" action="outdoor-db.php" class="update-user-box">
            <section class="input_container_update">
                <div>
                    <label for ="update-sin"> SIN </label>
                    <input class="field" type="number" id="update-sin" name="update-sin">
                </div>
                <div>
                    <label for ="update-name"> Name </label>
                    <input class="field" type="text" id="update-name" name="update-name">
                </div>
                <div>
                    <label for ="update-age"> Age </label>
                    <input class="field" type="number" id="update-age" name="update-age">
                </div>
                <div>
                    <label for ="update-exp"> Experience </label>
                    <select class="field" id="update-exp" name="update-exp">
                        <option disabled selected value> -- no selection -- </option>
                        <option value=1>Level 1</option>
                        <option value=2>Level 2</option>
                        <option value=3>Level 3</option>
                        <option value=4>Level 4</option>
                        <option value=5>Level 5</option>
                    </select>
                </div>
                <div>
                    <label for="update-first-aid"> First Aid Cert. </label>
                    <select class="field" id="update-first-aid" name="update-first-aid">
                        <option disabled selected value> -- no selection -- </option>
                        <option value=0>No</option>
                        <option value=1>Yes</option>
                    </select>
                </div>
                <div>
                    <label for="update-shelter-type"> Shelter </label>
                    <select class="field" id="update-shelter-type" name="update-shelter-type">
                        <option disabled selected value> -- no selection -- </option>
                        <option value="Tent">Tent</option>
                        <option value="Trailer">Trailer</option>
                        <option value="Van">Van</option>
                    </select>
                </div>
                
            </section>
            <input class="update_button" type="submit" value="Update" name="update-user-submit">
        </form>

    <?php

        function buildSetCmdString(&$map) {
            $arr = [];
            foreach($_POST as $key => $keyval) {
                if (array_key_exists($key, $map) && strlen($keyval) > 0) {
                    if ($key === "update-name" || $key === "update-shelter-type") {
                        array_push($arr, " " . $map[$key] . " = " . "'" . $keyval . "'");
                    } else {
                        array_push($arr, " " . $map[$key] . " = " . $keyval);
                    }
                   
                }
            }

            return implode(",", $arr);
        }

        /**
         * Execute the required UPDATE commands to make all changes. 
         * May be required to execute UPDATE for more than one table.
         */
        function handleUpdateUserRequest()
        {
            global $db_conn;
            global $person_map;
            global $hiker_map;
            global $camper_map;
            
            $cmd_list = array("person" => buildSetCmdString($person_map), 
                              "hiker" => buildSetCmdString($hiker_map), 
                              "camper" => buildSetCmdString($camper_map));
        
            foreach($cmd_list as $table => $cmdstr) {
                if (strlen($cmdstr) > 0) {
                    $format = "UPDATE %s SET %s WHERE sinnum = %s";
                    $query = sprintf($format, $table, $cmdstr, $_POST['update-sin']);
                    executePlainSQL($query);
                }
            }

            OCICommit($db_conn);
        }
        ?>
    </body>
</html>