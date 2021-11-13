<?php

/**
 * NOTES ABOUT THESE CONSTANTS
 * 
 * RENAME_MAP should contain all the possible WHERE string columns 
 * we will allow filtering on (i.e. the same keys as in SELECT_OPTIONS).
 * 
 * RENAME_ASMAP is used to build the SELECT string so should contain all possible
 * columns in the resulting join. Keys should be formatted to match any attribute 
 * disambiguation that is necessary (i.e. match table aliases in the SQL query.).
 * 
 * SELECT_OPTIONS are the options in the "Field" select dropdown that the user is allowed
 * to make a WHERE selection on (e.g. Difficulty > 10).
 * 
 * CHECKBOX OPTIONS should include all columns that are not in the PERSISTENT_COLS constant.
 * 
 */


// Campground Selection Constants
define("CAMPGROUND_PERSISTENT_COLS", ["CAMPGROUNDNAME", "COORDS"]);

define("CAMPGROUND_RENAME_MAP", array(
                                    "NUMWATERSOURCES" => "c.numWaterSources",
                                    "NUMSITES" => "ct.numSites",
                                    "NUMTOILETS" => "wt.NumToilets",
                                    "NUMSHOWERS" => "ts.numShowers"
));

define("CAMPGROUND_RENAME_ASMAP", array(
                                    "CAMPGROUNDNAME" => "campgroundName",
                                    "COORDS" => "coords",
                                    "CAMPTYPE" => "c.campType as campType",
                                    "DOGSALLOWED" => "ct.dogsAllowed as dogsAllowed",
                                    "NUMWATERSOURCES" => "c.numWaterSources as numWaterSources",
                                    "NUMSITES" => "ct.numSites as numSites",
                                    "NUMTOILETS" => "wt.numToilets as numToilets",
                                    "NUMSHOWERS" => "ts.numShowers as numShowers"
));

define("CAMPGROUND_SELECT_OPTIONS", array("NUMWATERSOURCES" => "Num Water Sources",
                                    "NUMSITES" => "Num Sites",
                                    "NUMTOILETS" => "Num Toilets",
                                    "NUMSHOWERS" => "Num Showers"
));

define("CAMPGROUND_CHECKBOX_OPTIONS", array("CAMPTYPE" => "Camp Type",
                                            "NUMWATERSOURCES" => "# of Water Sources",
                                            "NUMSITES" => "# of Sites",
                                            "NUMTOILETS" => "# of Toilets",
                                            "NUMSHOWERS" => "# of Showers",
                                            "DOGSALLOWED" => "DogsAllowed"
));

define("CAMPGROUND_SELECTION_SQL",  
"SELECT %s 
FROM campground c 
INNER JOIN campgroundtype ct ON c.camptype=ct.camptype
INNER JOIN waterToilets wt
ON c.numWaterSources=wt.numWaterSources
INNER JOIN toiletsShowers ts
ON wt.numToilets=ts.numToilets %s");

// Person Selection Constants

define("PERSON_PERSISTENT_COLS", ["SIN", "NAME"]);

define("PERSON_RENAME_MAP", array(
                                    "AGE" => "p.personage",
                                    "EXPERIENCELEVEL" => "h.ExperienceLevel",
                                    "FIRSTAIDCERT" => "h.FirstAidCert",
));

define("PERSON_RENAME_ASMAP", array(
                                    "SIN" => "p.sinnum as SIN",
                                    "AGE" => "personage as age",
                                    "NAME" => "personname as name",
                                    "SHELTERTYPE" => "c.shelterType as shelterType",
                                    "EXPERIENCELEVEL" => "h.experiencelevel as experienceLevel",
                                    "FIRSTAIDCERT" => "h.firstAidCert as firstAidCert",
));

define("PERSON_SELECT_OPTIONS", array("AGE" => "Age",
                                    "EXPERIENCELEVEL" => "Experience Level",
                                    "FIRSTAIDCERT" => "First Aid Certification"
));

define("PERSON_CHECKBOX_OPTIONS", array("AGE" => "Age",
                                        "SHELTERTYPE" => "Shelter Type",
                                        "EXPERIENCELEVEL" => "Experience Level",
                                        "FIRSTAIDCERT" => "First Aid Certification",
));

define("PERSON_SELECTION_SQL",  
"SELECT DISTINCT %s 
 FROM person p
 INNER JOIN camper c ON p.sinnum=c.sinnum
 INNER JOIN hiker h ON p.sinnum=h.sinnum %s");

// Parks Selection Constants
/**
 * SELECT DISTINCT PK.COORDS, PARKNAME, CAPACITY, DAYFEE, MEMBERSHIPPROGRAM
 * FROM PARK PK
 * INNER JOIN PROVINCIAL PR on PK.COORDS = PR.COORDS
 * INNER JOIN NATIONAL N on PK.COORDS = N.COORDS
 */

 // Hike Selection Constants

define("HIKE_PERSISTENT_COLS", ["TRAILNAME", "DIFFICULTY"]);

define("HIKE_RENAME_MAP", array(
                            "DISTANCE" => "d.distance",
                            "ELEVATIONGAIN" => "d.elevationGain",
                            "ESTIMATEDDURATION" => "estimatedduration",
                            "DIFFICULTY" => "difficulty"
));

define("HIKE_RENAME_ASMAP", array(
                                "TRAILNAME" => "trailname",
                                "DISTANCE" => "d.distance as distance",
                                "ELEVATIONGAIN" => "d.elevationGain as elevationGain",
                                "ESTIMATEDDURATION" => "estimatedDuration",
                                "DIFFICULTY" => "difficulty",
                                "COORDS" => "coords",
));

define("HIKE_SELECT_OPTIONS", array(
                                    "DISTANCE" => "Distance",
                                    "ELEVATIONGAIN" => "Elevation Gain",
                                    "ESTIMATEDDURATION" => "Estimated Duration",
                                    "DIFFICULTY" => "Difficulty"
));

define("HIKE_CHECKBOX_OPTIONS", array("ELEVATIONGAIN" => "Elevation Gain",
                                      "DISTANCE" => "Distance",
                                      "ESTIMATEDDURATION" => "Estimated Duration",
                                      "COORDS" => "Coordinates"
));

define("HIKE_SELECTION_SQL",
"SELECT DISTINCT %s
FROM DISTELEVDUR D
INNER JOIN HIKEDIFFICULTY H on D.DISTANCE = H.DISTANCE and D.ELEVATIONGAIN = H.ELEVATIONGAIN
INNER JOIN TRAILS T on D.DISTANCE = T.DISTANCE and D.ELEVATIONGAIN = T.ELEVATIONGAIN %s"
);
// Select SQL (must be defined last)

define("SELECT_SQL", array(
    "campground" => CAMPGROUND_SELECTION_SQL,
    "person" => PERSON_SELECTION_SQL,
    "hike" => HIKE_SELECTION_SQL
));
?>