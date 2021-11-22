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
ON wt.numToilets=ts.numToilets 
%s");

// Person Selection Constants

define("PERSON_PERSISTENT_COLS", ["SIN", "NAME"]);

define("PERSON_RENAME_MAP", array(
                                    "AGE" => "p.personage",
));

define("PERSON_RENAME_ASMAP", array(
                                    "SIN" => "p.sinnum as SIN",
                                    "AGE" => "personage as age",
                                    "NAME" => "personname as name",
));

define("PERSON_SELECT_OPTIONS", array("AGE" => "Age",
));

define("PERSON_CHECKBOX_OPTIONS", array("AGE" => "Age",
));

define("PERSON_SELECTION_SQL",  
"SELECT DISTINCT %s 
 FROM person p
 %s");

 // Person Hiker
 define("HIKER_PERSISTENT_COLS", ["SIN", "NAME"]);

define("HIKER_RENAME_MAP", array(
                                    "AGE" => "p.personage",
                                    "EXPERIENCELEVEL" => "h.ExperienceLevel",
                                    "FIRSTAIDCERT" => "h.FirstAidCert",
));

define("HIKER_RENAME_ASMAP", array(
                                    "SIN" => "p.sinnum as SIN",
                                    "AGE" => "personage as age",
                                    "NAME" => "personname as name",
                                    "EXPERIENCELEVEL" => "h.experiencelevel as experienceLevel",
                                    "FIRSTAIDCERT" => "h.firstAidCert as firstAidCert",
));

define("HIKER_SELECT_OPTIONS", array("AGE" => "Age",
                                    "EXPERIENCELEVEL" => "Experience Level",
                                    "FIRSTAIDCERT" => "First Aid Certification"
));

define("HIKER_CHECKBOX_OPTIONS", array("AGE" => "Age",
                                        "EXPERIENCELEVEL" => "Experience Level",
                                        "FIRSTAIDCERT" => "First Aid Certification",
));

define("HIKER_SELECTION_SQL",  
"SELECT DISTINCT %s 
 FROM person p
 INNER JOIN hiker h ON p.sinnum=h.sinnum 
 %s");

 // Person Camper
 define("CAMPER_PERSISTENT_COLS", ["SIN", "NAME"]);

 define("CAMPER_RENAME_MAP", array(
                                     "AGE" => "p.personage",
 ));
 
 define("CAMPER_RENAME_ASMAP", array(
                                     "SIN" => "p.sinnum as SIN",
                                     "AGE" => "personage as age",
                                     "NAME" => "personname as name",
                                     "SHELTERTYPE" => "c.shelterType as shelterType",
 ));
 
 define("CAMPER_SELECT_OPTIONS", array("AGE" => "Age",
 ));
 
 define("CAMPER_CHECKBOX_OPTIONS", array("AGE" => "Age",
                                         "SHELTERTYPE" => "Shelter Type",
 ));
 
 define("CAMPER_SELECTION_SQL",  
 "SELECT DISTINCT %s 
  FROM person p
  INNER JOIN camper c ON p.sinnum=c.sinnum
  %s");

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
INNER JOIN TRAILS T on D.DISTANCE = T.DISTANCE and D.ELEVATIONGAIN = T.ELEVATIONGAIN 
%s"
);

// Hiking Trip
define("HIKINGTRIP_PERSISTENT_COLS", ["HIKINGTRIPID", "TRAILNAME"]);

define("HIKINGTRIP_RENAME_MAP", array(
                            "DURATION" => "duration"
));

define("HIKINGTRIP_RENAME_ASMAP", array(
                                "HIKINGTRIPID" => "hikingtripID",
                                "HIKEDATE" => "hikedate",
                                "TRAILNAME" => "trailname",
                                "DURATION" => "duration",
                                "SINNUM" => "sinnum",
                                "COORDS" => "coords",
));

define("HIKINGTRIP_SELECT_OPTIONS", array(
                                    "DURATION" => "Duration",
));

define("HIKINGTRIP_CHECKBOX_OPTIONS", array("HIKEDATE" => "Trail Name",
                                      "SINNUM" => "SIN",
                                      "DURATION" => "Duration",
                                      "COORDS" => "Coordinates"
));

define("HIKINGTRIP_SELECTION_SQL", 
"SELECT %s
FROM HIKINGTRIP
%s
");

// Reservation
define("RESERVATION_PERSISTENT_COLS", ["CONFIRMATIONID", "CAMPGROUNDNAME"]);

define("RESERVATION_RENAME_MAP", array(
                            "SITEID" => "siteID"
));

define("RESERVATION_RENAME_ASMAP", array(
                                "CONFIRMATIONID" => "confirmationID",
                                "ARRIVALDATE" => "arrivalDate",
                                "DEPDATE" => "depdate",
                                "SITEID" => "siteID",
                                "SINNUM" => "sinnum",
                                "CAMPGROUNDNAME" => "campgroundName",
));

define("RESERVATION_SELECT_OPTIONS", array(
                                    "SITEID" => "Site ID",
));

define("RESERVATION_CHECKBOX_OPTIONS", array(
                                "ARRIVALDATE" => "Arrival Date",
                                "DEPDATE" => "Departure Date",
                                "SITEID" => "Site ID",
                                "SINNUM" => "SIN",
));

define("RESERVATION_SELECTION_SQL", 
"SELECT %s
FROM RESERVATION
%s
");

// Park
define("PARK_PERSISTENT_COLS", ["PARKNAME"]);

define("PARK_RENAME_MAP", array(
                            "CAPACITY" => "capacity"
));

define("PARK_RENAME_ASMAP", array(
                                "PARKNAME" => "parkname",
                                "COORDS" => "coords",
                                "CAPACITY" => "capacity"
));

define("PARK_SELECT_OPTIONS", array(
                                    "CAPACITY" => "Capacity",
));

define("PARK_CHECKBOX_OPTIONS", array(
                                    "COORDS" => "Coordinates",
                                    "CAPACITY" => "Capacity"
));

define("PARK_SELECTION_SQL",
"SELECT %s
 FROM PARK
 %s
");

// ProvincialPark
define("PROV_PERSISTENT_COLS", ["PARKNAME"]);

define("PROV_RENAME_MAP", array(
                            "CAPACITY" => "capacity",
                            "DAYFEE" => "dayfee"
));

define("PROV_RENAME_ASMAP", array(
                                "PARKNAME" => "parkname",
                                "COORDS" => "p.coords as coords",
                                "CAPACITY" => "capacity",
                                "DAYFEE" => "dayfee"
));

define("PROV_SELECT_OPTIONS", array(
                                    "CAPACITY" => "Capacity",
                                    "DAYFEE" => "Day Fee"
));

define("PROV_CHECKBOX_OPTIONS", array(
                                    "COORDS" => "Coordinates",
                                    "CAPACITY" => "Capacity",
                                    "DAYFEE" => "Day Fee"
));

define("PROV_SELECTION_SQL",
"SELECT %s
 FROM PARK P
 INNER JOIN  PROVINCIAL PR ON P.COORDS = PR.COORDS
 %s
");

// Provincial Parks
define("NAT_PERSISTENT_COLS", ["PARKNAME"]);

define("NAT_RENAME_MAP", array(
                            "CAPACITY" => "capacity",
));

define("NAT_RENAME_ASMAP", array(
                                "PARKNAME" => "parkname",
                                "COORDS" => "p.coords as coords",
                                "CAPACITY" => "capacity",
                                "MEMBERSHIPPROGRAM" => "membershipprogram"
));

define("NAT_SELECT_OPTIONS", array(
                                    "CAPACITY" => "Capacity",
));

define("NAT_CHECKBOX_OPTIONS", array(
                                    "COORDS" => "Coordinates",
                                    "CAPACITY" => "Capacity",
                                    "MEMBERSHIPPROGRAM" => "Membership Program"
));

define("NAT_SELECTION_SQL",
"SELECT %s
 FROM PARK P
 INNER JOIN  NATIONAL N ON P.COORDS = N.COORDS
 %s
");

// Viewpoints
define("VIEWPOINT_PERSISTENT_COLS", ["VIEWPOINTNAME"]);

define("VIEWPOINT_RENAME_MAP", array(
                                "CAPACITY" => "capacity"
));

define("VIEWPOINT_RENAME_ASMAP", array(
                                "VIEWPOINTNAME" => "viewpointname",
                                "COORDS" => "v.coords as coords",
                                "PARKNAME" => "parkname",
                                "CATEGORY" => "category",
                                "CAPACITY" => "capacity"
));

define("VIEWPOINT_SELECT_OPTIONS", array(
                                "CAPACITY" => "Capacity"
));

define("VIEWPOINT_CHECKBOX_OPTIONS", array(
                                "CATEGORY" => "Category",
                                "COORDS" => "Coordinates",
                                "PARKNAME" => "Park Name",
                                "CAPACITY" => "Capacity"
));

define("VIEWPOINT_SELECTION_SQL",
"SELECT %s
 FROM VIEWPOINTS V
 INNER JOIN  PARK P ON P.COORDS = V.COORDS
 %s
");

// Lakes
define("LAKE_PERSISTENT_COLS", ["LAKENAME"]);

define("LAKE_RENAME_MAP", array(
                                "ELEVATION" => "elevation",
                                "AREASIZE" => "areasize",
                                "CAPACITY" => "capacity"
));

define("LAKE_RENAME_ASMAP", array(
                                "LAKENAME" => "lakename",
                                "COORDS" => "l.coords as coords",
                                "PARKNAME" => "parkname",
                                "ELEVATION" => "elevation",
                                "CAPACITY" => "capacity"
));

define("LAKE_SELECT_OPTIONS", array(
                                "ELEVATION" => "Elevation",
                                "AREASIZE" => "Lake Size (AREA)",
                                "CAPACITY" => "Capacity"
));

define("LAKE_CHECKBOX_OPTIONS", array(
                                "ELEVATION" => "elevation",
                                "COORDS" => "Coordinates",
                                "PARKNAME" => "Park Name",
                                "CAPACITY" => "Capacity"
));

define("LAKE_SELECTION_SQL",
"SELECT %s
 FROM LAKES L
 INNER JOIN  PARK P ON P.COORDS = L.COORDS
 %s
");

// Day Trips
define("DAYTRIP_PERSISTENT_COLS", ["TRIPID"]);

define("DAYTRIP_RENAME_MAP", array(
                                "ELEVATION" => "elevation",
                                "AREASIZE" => "areasize",
                                "CAPACITY" => "capacity"
));

define("DAYTRIP_RENAME_ASMAP", array(
                                "TRIPID" => "tripid",
                                "TRIPDATE" => "tripdate",
                                "COORDS" => "d.coords as coords",
                                "PARKNAME" => "parkname",
                                "CAPACITY" => "capacity"
));

define("DAYTRIP_SELECT_OPTIONS", array(
                                "CAPACITY" => "Capacity"
));

define("DAYTRIP_CHECKBOX_OPTIONS", array(
                                "TRIPDATE" => "elevation",
                                "COORDS" => "Coordinates",
                                "PARKNAME" => "Park Name",
                                "CAPACITY" => "Capacity"
));

define("DAYTRIP_SELECTION_SQL",
"SELECT %s
 FROM DAYTRIPS D
 INNER JOIN  PARK P ON P.COORDS = D.COORDS
 %s
");

// Select SQL (must be defined last)

define("SELECT_SQL", array(
    "campground" => CAMPGROUND_SELECTION_SQL,
    "person" => PERSON_SELECTION_SQL,
    "hike" => HIKE_SELECTION_SQL,
    "hikingtrip" => HIKINGTRIP_SELECTION_SQL,
    "reservation" => RESERVATION_SELECTION_SQL,
    "park" => PARK_SELECTION_SQL,
    "provincialpark" => PROV_SELECTION_SQL,
    "nationalpark" => NAT_SELECTION_SQL,
    "camper" => CAMPER_SELECTION_SQL,
    "hiker" => HIKER_SELECTION_SQL,
    "viewpoint" => VIEWPOINT_SELECTION_SQL,
    "lake" => LAKE_SELECTION_SQL,
    "daytrip" => DAYTRIP_SELECTION_SQL
));
?>