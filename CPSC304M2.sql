-- drop statements
drop table PERSON cascade constraints;
drop table CAMPER cascade constraints;
drop table HIKER cascade constraints;

drop table PARK cascade constraints;
drop table PROVINCIAL cascade constraints;
drop table NATIONAL cascade constraints;

drop table DAYTRIPS cascade constraints;
drop table VIEWPOINTS cascade constraints;
drop table LAKES cascade constraints;

drop table HIKINGTRIP cascade constraints;
drop table RESERVATION cascade constraints;

drop table DISTELEVDUR cascade constraints;
drop table HIKEDIFFICULTY cascade constraints;
drop table TRAILS cascade constraints;

drop table CAMPGROUND cascade constraints;
drop table CAMPGROUNDTYPE cascade constraints;
drop table WATERTOILETS cascade constraints;
drop table TOILETSSHOWERS cascade constraints;


-- create tables 

CREATE TABLE Person (
  sinNum Integer PRIMARY KEY,
  personAge Integer,
  personName char(50) NOT NULL
);

CREATE TABLE Camper (
  sinNum Integer PRIMARY KEY,
  shelterType char(50),
  FOREIGN KEY (sinNum) REFERENCES Person ON DELETE CASCADE
); 

CREATE TABLE Hiker (
  sinNum Integer PRIMARY KEY,
  experienceLevel Integer,
  firstAidCert Integer,
  FOREIGN KEY (sinNum) REFERENCES Person ON DELETE CASCADE
);

CREATE TABLE Park (
  coords char(20) PRIMARY KEY,
  parkName char(50) NOT NULL,
  capacity Integer
);

CREATE TABLE Provincial (
  coords char(20) PRIMARY KEY,
  dayFee Integer,
  FOREIGN KEY (coords) REFERENCES Park ON DELETE CASCADE
);

CREATE TABLE National (
  coords char(20) PRIMARY KEY,
  membershipProgram char(50),
  FOREIGN KEY (coords) REFERENCES Park ON DELETE CASCADE
);

CREATE TABLE DayTrips (
  tripID char(20) PRIMARY KEY,
  coords char(20),
  tripDate date NOT NULL,
  FOREIGN KEY (coords) REFERENCES Park ON DELETE CASCADE
);

CREATE TABLE ViewPoints (
  viewpointName char(50) PRIMARY KEY,
  coords char(20),
  category char(20) NOT NULL,
  FOREIGN KEY (coords) REFERENCES Park ON DELETE CASCADE
);

CREATE TABLE Lakes (
  lakeID char(20) PRIMARY KEY,
  coords char(20),
  elevation Integer,
  areaSize Integer,
  lakeName char(50) NOT NULL,
  FOREIGN KEY (coords) REFERENCES Park ON DELETE CASCADE
);

CREATE TABLE DistElevDur (
  distance Integer,
  elevationGain Integer,
  estimatedDuration Integer NOT NULL,
  PRIMARY KEY (distance, elevationGain)
);

CREATE TABLE HikeDifficulty (
  distance Integer,
  elevationGain Integer,
  difficulty Integer NOT NULL,
  maxAltitude Integer NOT NULL,
  PRIMARY KEY (distance, elevationGain),
  FOREIGN KEY (distance, elevationGain) REFERENCES DistElevDur ON DELETE CASCADE
);

CREATE TABLE Trails (
  trailName char(50) PRIMARY KEY,
  distance Integer NOT NULL,
  elevationGain Integer NOT NULL,
  coords char(20),
  FOREIGN KEY (coords) REFERENCES Park ON DELETE CASCADE,
  FOREIGN KEY (distance, elevationGain) REFERENCES DistElevDur ON DELETE CASCADE
);

CREATE TABLE CampgroundType(
  campType char(20) PRIMARY KEY,
  dogsAllowed Integer NOT NULL,
  numSites Integer NOT NULL
);

CREATE TABLE WaterToilets (
  numWaterSources Integer PRIMARY KEY,
  numToilets Integer NOT NULL
);

CREATE TABLE ToiletsShowers (
  numToilets Integer PRIMARY KEY,
  numShowers Integer NOT NULL
);

CREATE TABLE Campground (
  campgroundName char(20),
  coords char(20), 
  campType char(20) NOT NULL,
  numWaterSources Integer NOT NULL,
  PRIMARY KEY (campgroundName, campType),
  FOREIGN KEY (coords) REFERENCES Park ON DELETE CASCADE,
  FOREIGN KEY (campType) REFERENCES CampgroundType ON DELETE CASCADE,
  FOREIGN KEY (numWaterSources) REFERENCES WaterToilets ON DELETE CASCADE
);

CREATE TABLE HikingTrip (
  hikingTripID char(20) PRIMARY KEY,
  coords char(20),
  sinNum Integer,
  trailName char(50),
  hikeDate date NOT NULL,
  duration Integer,
  FOREIGN KEY (sinNum) REFERENCES Person ON DELETE CASCADE,
  FOREIGN KEY (trailName) REFERENCES Trails ON DELETE CASCADE,
  FOREIGN KEY (coords) REFERENCES Park ON DELETE CASCADE
);

CREATE TABLE Reservation (
  confirmationID char(20) PRIMARY KEY,
  arrivalDate date,
  siteID Integer,
  sinNum Integer,
  campgroundName char(20),
  campType char(50),
  depDate date NOT NULL,
  FOREIGN KEY (campgroundName, campType) REFERENCES Campground ON DELETE CASCADE,
  FOREIGN KEY (campType) REFERENCES CampgroundType ON DELETE CASCADE,
  FOREIGN KEY (sinNum) REFERENCES Person ON DELETE CASCADE
);

INSERT INTO Person (sinNum, personAge, personName)
VALUES (120340560,15,'Kevin Hutt');
INSERT INTO Person (sinNum, personAge, personName)
VALUES (112233445, 40, 'Ruth While');
INSERT INTO Person (sinNum, personAge, personName)
VALUES (120340561, 33,'Keith Heal');
INSERT INTO Person (sinNum, personAge, personName)
VALUES (120340567, 94,'Laura Quart');
INSERT INTO Person (sinNum, personAge, personName)
VALUES (120340562,77,'Kalie Hattt');

INSERT INTO Camper (sinNum, shelterType)
VALUES (120340560,'Tent');
INSERT INTO Camper (sinNum, shelterType)
VALUES (112233445, 'Trailer');
INSERT INTO Camper (sinNum, shelterType)
VALUES (120340561, 'Van');
INSERT INTO Camper (sinNum, shelterType)
VALUES (120340567, 'Tent');
INSERT INTO Camper (sinNum, shelterType)
VALUES (120340562, 'Trailer');

INSERT INTO Hiker (sinNum, experienceLevel, firstAidCert)
VALUES (120340560, 1, 0);
INSERT INTO Hiker (sinNum, experienceLevel, firstAidCert)
VALUES (112233445, 3, 0);
INSERT INTO Hiker (sinNum, experienceLevel, firstAidCert)
VALUES (120340561, 5, 1);
INSERT INTO Hiker (sinNum, experienceLevel, firstAidCert)
VALUES (120340567, 3, 0);
INSERT INTO Hiker (sinNum, experienceLevel, firstAidCert)
VALUES (120340562, 2, 0);

INSERT INTO Park (coords, parkName, capacity)
VALUES ('41.40338, 4.17403', 'Cypress', 100);
INSERT INTO Park (coords, parkName, capacity)
VALUES ('45.40338, 2.17403', 'MacGregor', 222);
INSERT INTO Park (coords, parkName, capacity)
VALUES ('47.40338, 3.17403', 'Golden Ears', 330);
INSERT INTO Park (coords, parkName, capacity)
VALUES ('49.40338, 6.17403', 'Lake Superior', 130);
INSERT INTO Park (coords, parkName, capacity)
VALUES ('30.40338, 7.17403', 'Inverhuron', 241);
INSERT INTO Park (coords, parkName, capacity)
VALUES ('44.40338, 6.17403', 'Killarney', 344);
INSERT INTO Park (coords, parkName, capacity)
VALUES ('46.40338, 7.17403', 'Pacific Rim', 567);
INSERT INTO Park (coords, parkName, capacity)
VALUES ('55.40338, 1.17403', 'Jasper', 54);
INSERT INTO Park (coords, parkName, capacity)
VALUES ('34.40338, 2.17403', 'Yoho', 765);
INSERT INTO Park (coords, parkName, capacity)
VALUES ('23.40338, 3.17403', 'Banff', 544);

INSERT INTO Provincial (coords, dayFee)
VALUES ('41.40338, 4.17403', 30);
INSERT INTO Provincial (coords, dayFee)
VALUES ('45.40338, 2.17403', 22);
INSERT INTO Provincial (coords, dayFee)
VALUES ('47.40338, 3.17403', 11);
INSERT INTO Provincial (coords, dayFee)
VALUES ('49.40338, 6.17403', 12);
INSERT INTO Provincial (coords, dayFee)
VALUES ('30.40338, 7.17403', 14);


INSERT INTO National (coords, membershipProgram)
VALUES ('44.40338, 6.17403', 'greenCamp');
INSERT INTO National (coords, membershipProgram)
VALUES ('46.40338, 7.17403', 'greenSpace');
INSERT INTO National (coords, membershipProgram)
VALUES ('55.40338, 1.17403', 'greenCamp');
INSERT INTO National (coords, membershipProgram)
VALUES ('34.40338, 2.17403', 'veryGreenCamp');
INSERT INTO National (coords, membershipProgram)
VALUES ('23.40338, 3.17403', 'superGreenSpace');

INSERT INTO DayTrips (coords, tripID, tripDate)
VALUES ('44.40338, 6.17403', '1234D', TO_DATE('1995-08-20', 'yyyy-mm-dd'));
INSERT INTO DayTrips (coords, tripID, tripDate)
VALUES ('46.40338, 7.17403', '1434E', TO_DATE('2000-10-23', 'yyyy-mm-dd'));
INSERT INTO DayTrips (coords, tripID, tripDate)
VALUES ('55.40338, 1.17403', '143FF', TO_DATE('2010-09-14', 'yyyy-mm-dd'));
INSERT INTO DayTrips (coords, tripID, tripDate)
VALUES ('34.40338, 2.17403', '7865D', TO_DATE('2020-10-03', 'yyyy-mm-dd'));
INSERT INTO DayTrips (coords, tripID, tripDate)
VALUES ('23.40338, 3.17403', '8976G', TO_DATE('2019-01-14', 'yyyy-mm-dd'));

INSERT INTO ViewPoints (coords, viewpointName, category)
VALUES ('44.40338, 6.17403', 'WOW', 'waterfall');
INSERT INTO ViewPoints (coords, viewpointName, category)
VALUES ('46.40338, 7.17403', 'BEAUTIFUL HILL', 'hill');
INSERT INTO ViewPoints (coords, viewpointName, category)
VALUES ('55.40338, 1.17403', 'COOL CLIFF', 'cliff');
INSERT INTO ViewPoints (coords, viewpointName, category)
VALUES ('34.40338, 2.17403', 'VERY BIG HILL', 'hill');
INSERT INTO ViewPoints (coords, viewpointName, category)
VALUES ('23.40338, 3.17403', 'SUPER BIG HILL', 'hill');

INSERT INTO Lakes (coords, lakeID, elevation, areaSize, lakeName)
VALUES ('41.40338, 4.17403', 'HGYFD', 453, 56, 'green lake');
INSERT INTO Lakes (coords, lakeID, elevation, areaSize, lakeName)
VALUES ('45.40338, 2.17403', 'HYERF', 432, 786, 'blue lake');
INSERT INTO Lakes (coords, lakeID, elevation, areaSize, lakeName)
VALUES ('47.40338, 3.17403', 'GHDFT', 1330, 789, 'pink lake');
INSERT INTO Lakes (coords, lakeID, elevation, areaSize, lakeName)
VALUES ('49.40338, 6.17403', 'HYDGS', 2300, 564, 'happy lake');
INSERT INTO Lakes (coords, lakeID, elevation, areaSize, lakeName)
VALUES ('30.40338, 7.17403', 'GTDFS', 5400, 689, 'sad lake');

INSERT INTO DistElevDur (distance, elevationGain, estimatedDuration)
VALUES (13, 4000, 2);
INSERT INTO DistElevDur (distance, elevationGain, estimatedDuration)
VALUES (11, 3400, 3);
INSERT INTO DistElevDur (distance, elevationGain, estimatedDuration)
VALUES (12, 1200, 7);
INSERT INTO DistElevDur (distance, elevationGain, estimatedDuration)
VALUES (4, 5600, 6);
INSERT INTO DistElevDur (distance, elevationGain, estimatedDuration)
VALUES (60, 8900, 55);

INSERT INTO HikeDifficulty (distance, elevationGain, difficulty, maxAltitude)
VALUES (13, 4000, 1, 100);
INSERT INTO HikeDifficulty (distance, elevationGain, difficulty, maxAltitude)
VALUES (11, 3400, 5, 500);
INSERT INTO HikeDifficulty (distance, elevationGain, difficulty, maxAltitude)
VALUES (12, 1200, 3, 350);
INSERT INTO HikeDifficulty (distance, elevationGain, difficulty, maxAltitude)
VALUES (4, 5600, 15, 1100);
INSERT INTO HikeDifficulty (distance, elevationGain, difficulty, maxAltitude)
VALUES (60, 8900, 13, 800);

INSERT INTO Trails (trailName, coords, distance, elevationGain)
VALUES ('hard trail','44.40338, 6.17403', 13, 4000);
INSERT INTO Trails (trailName, coords, distance, elevationGain)
VALUES ('soft trail', '46.40338, 7.17403', 11, 3400);
INSERT INTO Trails (trailName, coords, distance, elevationGain)
VALUES ('easy trail','55.40338, 1.17403', 12, 1200);
INSERT INTO Trails (trailName, coords, distance, elevationGain)
VALUES ('kind of easy trail','34.40338, 2.17403', 4, 5600);
INSERT INTO Trails (trailName, coords, distance, elevationGain)
VALUES ('rough trail','23.40338, 3.17403', 60, 8900);

INSERT INTO HikingTrip (hikingTripID, coords, sinNum, trailName, hikeDate, duration)
VALUES ('HISHRE','44.40338, 6.17403', 120340560, 'hard trail', TO_DATE('2019-08-20', 'yyyy-mm-dd'), 2);
INSERT INTO HikingTrip (hikingTripID, coords, sinNum, trailName, hikeDate, duration)
VALUES ('HIDJSS','46.40338, 7.17403', 112233445, 'soft trail', TO_DATE('2020-09-10', 'yyyy-mm-dd'), 4);
INSERT INTO HikingTrip (hikingTripID, coords, sinNum, trailName, hikeDate, duration)
VALUES ('JNUYBS','55.40338, 1.17403', 120340561, 'easy trail', TO_DATE('2020-10-12', 'yyyy-mm-dd'), 5);
INSERT INTO HikingTrip (hikingTripID, coords, sinNum, trailName, hikeDate, duration)
VALUES ('NMBYSD', '34.40338, 2.17403',120340567, 'kind of easy trail', TO_DATE('2021-03-12', 'yyyy-mm-dd'), 3);
INSERT INTO HikingTrip (hikingTripID, coords, sinNum, trailName, hikeDate, duration)
VALUES ('NHDYSH','23.40338, 3.17403', 120340562, 'rough trail', TO_DATE('2017-12-11', 'yyyy-mm-dd'), 65);

INSERT INTO ToiletsShowers (numToilets, numShowers)
VALUES (10, 12);
INSERT INTO ToiletsShowers (numToilets, numShowers)
VALUES (11, 6);
INSERT INTO ToiletsShowers (numToilets, numShowers)
VALUES (12, 5);
INSERT INTO ToiletsShowers (numToilets, numShowers)
VALUES (30, 23);
INSERT INTO ToiletsShowers (numToilets, numShowers)
VALUES (23, 13);


INSERT INTO WaterToilets (numWaterSources, numToilets)
VALUES (4,10);
INSERT INTO WaterToilets (numWaterSources, numToilets)
VALUES (6,11);
INSERT INTO WaterToilets (numWaterSources, numToilets)
VALUES (7,12);
INSERT INTO WaterToilets (numWaterSources, numToilets)
VALUES (8,30);
INSERT INTO WaterToilets (numWaterSources, numToilets)
VALUES (10,23);

INSERT INTO CampgroundType (CampType, DogsAllowed, NumSites)
VALUES ('Front Country', 1, 322);
INSERT INTO CampgroundType (CampType, DogsAllowed, NumSites)
VALUES ('Back Country', 0, 455);
INSERT INTO CampgroundType (CampType, DogsAllowed, NumSites)
VALUES ('RV', 1, 43);
INSERT INTO CampgroundType (CampType, DogsAllowed, NumSites)
VALUES ('Canoe Country', 0, 322);
INSERT INTO CampgroundType (CampType, DogsAllowed, NumSites)
VALUES ('Glacier Camp', 0, 122);

INSERT INTO Campground (CampType, numWaterSources, CampgroundName, Coords)
VALUES ('Front Country', 4, 'Golden Ears', '41.40338, 4.17403');
INSERT INTO Campground (CampType, numWaterSources, CampgroundName, Coords)
VALUES ('Back Country', 6, 'Silver Ears', '45.40338, 2.17403');
INSERT INTO Campground (CampType, numWaterSources, CampgroundName, Coords)
VALUES ('RV', 7, 'Chartreuse Ears','47.40338, 3.17403');
INSERT INTO Campground (CampType, numWaterSources, CampgroundName, Coords)
VALUES ('Canoe Country', 8, 'Purple Ears', '49.40338, 6.17403');
INSERT INTO Campground (CampType, numWaterSources, CampgroundName, Coords)
VALUES ('Glacier Camp', 10, 'Orange Ears', '30.40338, 7.17403');

INSERT INTO Reservation (confirmationID, sinNum, campgroundName, arrivalDate, depDate, siteID)
VALUES ('aaaa123545', 120340560, 'Golden Ears', TO_DATE('2015-07-13', 'yyyy-mm-dd'), TO_DATE('2015-07-20', 'yyyy-mm-dd'), 3534);
INSERT INTO Reservation (confirmationID, sinNum, campgroundName, arrivalDate, depDate, siteID)
VALUES ('aakhld2345', 112233445, 'Silver Ears', TO_DATE('2013-04-05', 'yyyy-mm-dd'), TO_DATE('2013-04-25', 'yyyy-mm-dd'), 8234);
INSERT INTO Reservation (confirmationID, sinNum, campgroundName, arrivalDate, depDate, siteID)
VALUES ('aagda45345', 120340561, 'Chartreuse Ears', TO_DATE('2003-01-13', 'yyyy-mm-dd'), TO_DATE('2003-02-14', 'yyyy-mm-dd'), 1224);
INSERT INTO Reservation (confirmationID, sinNum, campgroundName, arrivalDate, depDate, siteID)
VALUES ('bcsa12f345', 120340567, 'Purple Ears', TO_DATE('1999-08-13', 'yyyy-mm-dd'), TO_DATE('1999-09-01', 'yyyy-mm-dd'), 1034);
INSERT INTO Reservation (confirmationID, sinNum, campgroundName, arrivalDate, depDate, siteID)
VALUES ('aafjk12345', 120340562, 'Orange Ears', TO_DATE('2019-03-25', 'yyyy-mm-dd'), TO_DATE('2019-08-14', 'yyyy-mm-dd'), 1584);
