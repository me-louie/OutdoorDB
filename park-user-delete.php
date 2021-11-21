<html>

<head>

<body>
    <h3>Delete User:</h3>

    <form method="POST" action="outdoor-db.php" class="add_user_box">
        <section class="input_container">
            <input type="hidden" id="delete-user" name="delete-user">
            <div>
                <label for ="sin"> SIN </label>
                <input class="field" type="number" id="delete-sin" name="delete-sin">
            </div>
        </section>
        <input class="delete_button" type="submit" value="Delete" name="delete-user-submit">
    </form>


    <?php

        function buildCmdString(&$map) {
            $arr = [];
            foreach($_POST as $key => $keyval) {
                if (array_key_exists($key, $map) && strlen($keyval) > 0) {
                    array_push($arr, " " . $map[$key] . " = " . $keyval);
                    }  
                }

            return implode(",", $arr);
        }

        /**
         * Execute the required DELETE ON CASCADE
         */
        function handleDeleteUserRequest()
        {
            global $db_conn;
            global $person_map;
            global $hiker_map;
            global $camper_map;
            
            $cmd_list = array("person" => buildCmdString($person_map), 
                              "hiker" => buildCmdString($hiker_map), 
                              "camper" => buildCmdString($camper_map));
        
            foreach($cmd_list as $table => $cmdstr) {
                if (strlen($cmdstr) > 0) {
                    $format = "DELETE FROM %s WHERE sinnum = %s";
                    $query = sprintf($format, $table, $cmdstr, $_POST['delete-sin']);
                    executePlainSQL($query);
                }
            }

            OCICommit($db_conn);
        }
    ?>

</body>
</head>

</html>