<?php


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

// define("PERSON_SELECTION_SQL",  
// "SELECT DISTINCT %s 
//  FROM person p, camper c, hiker h
//  WHERE p.sinnum=c.sinnum and 
//        p.sinnum=h.sinnum and %s");

define("PERSON_SELECTION_SQL",  
"SELECT DISTINCT %s 
 FROM person p
 INNER JOIN camper c ON p.sinnum=c.sinnum
 INNER JOIN hiker h ON p.sinnum=h.sinnum %s");

// Select SQL (must be defined last)

define("SELECT_SQL", array(
    "campground" => CAMPGROUND_SELECTION_SQL,
    "person" => PERSON_SELECTION_SQL
));
?>