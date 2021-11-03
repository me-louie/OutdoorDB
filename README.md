# project_q4v2b_u7v2b_w4v2b

# <h3>Creators</h3>
# Thomas Cowan
# Mikayla Louie
# Lauren Kerker

# <h3>About Project</h3>

# This database contains information about outdoor recreation in Provincial and National Parks within Canada. It stores data
# about lakes, viewpoints and trails, as well as day trips, campground reservations and hiking trips. The purpose of this
# application is to monitor and control the traffic of people through Provincial and National parks. Due to COVID and environmental preservation, 
# staying within park capacity is important. It also serves as a tool to determine which trails need more maintenance based on how many people 
# hiked the trail. 

# <h3>Tables in Database + Primary & Foreign keys:</h3>

# *primary key*
# **foreign key**

# Person(*SIN: Integer*, Age: Integer, PersonName: Char(50))
# Camper(***SIN: Integer***, ShelterType: Char(50))
# Hiker(***SIN: Integer***, ExperienceLevel: Integer, FirstAidCert: Integer)

# Park(*Coords: Char(20)*, ParkName: Char(50), Capacity: Integer)
# Provincial(***Coords: Char(20)***, DayFee: Integer)
# National(***Coords: Char(20)***, MembershipProgram: Char(50))

# DayTrips(*TripID: Char(20)*, **Coords: Char(20)**, TripDate: Date)

# ViewPoints(*ViewPointName: Char(50)*, **Coords: Char(20)**, Category: Char(20))
# Lakes(*LakeID: Char(20)*, **Coords: Char(20)**, Elevation: Integer, AreaSize: Integer, LakeName: Char(50))

# HikingTrip(*HikingTripID: Char(20)*, **SIN: Integer**, **TrailName: Char(50)**, **Coords: Char(20)**, HikeDate: Date, Duration: Integer)

# Reservation(*ConfirmationID: Char(20)*, *ArrivalDate: Date*, *SiteID: Integer*, **SIN: Integer**, **CampgroundName: Char(50)**,  **CampType: Char(50)**, DepDate: Date,)  

# DistElevDur(*Distance*, *ElevationGain*, EstimatedDuration)
# HikeDifficutly(***Distance***, ***ElevationGain***, Difficulty, MaxAltitude)
# Trails(*TrailName*, **Distance**, **ElevationGain**, **Coords**)

# ToiletsShowers(*NumToilets*, NumShowers)
# WaterToilets(*NumWaterSources*, NumToilets)
# CampgroundType(*CampType*, DogsAllowed, NumSites)
# Campground(*CampgroundName*, ***CampType***, **NumWaterSources**, **Coords**)
