# SMURF DETECTOR
This is a small web admintool for the sourcemod plugin **[ANY] Player Analytics** by Dr. McKay
https://forums.alliedmods.net/showthread.php?t=230832

forked from Sinclair47/player_analytics https://github.com/Sinclair47/player_analytics 

## What does it do?
This webapp simply searches for all different IP's in the playeranalytics database which belong to a steam account and then looks for other accounts which were connected to this IP's.  
The chances of that accounts being smurf/alt accounts is let's say 95% :)

The other 5% could be:
- same internet connection (LAN parties, family members, living communitys, school/uni/internet café network, etc...)
- account sharing (borrowed accounts from friends, etc...)
- some ISPs share IP between multiple people in a city since there is a shorttage of ip4v adresses

So keep that in mind!

## How to install?

### Requirements

- **[ANY] Player Analytics** by Dr. McKay https://forums.alliedmods.net/showthread.php?t=230832
- **SteamFunctions** by nineteeneleven (already included) https://github.com/nineteeneleven/SteamFunctions

### Instructions
Download as zip (or clone) and copy all files to your webserver.  
Add your DB credentials in config.php.
 
That's it!

## Todo
* nothing yet

## Screenshot
![SMURF DETECTOR 2.0](https://raw.githubusercontent.com/nap10/smurfdetector/master/smurf_detector.png)

