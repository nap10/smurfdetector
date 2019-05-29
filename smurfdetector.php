<html>

<head>
    <title>SMURF DETECTOR</title>
	
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 15px;
  text-align: left;
}
table#t01 {
  table-layout: fixed ;
  width: 48%;    
  background-color: #f1f1c1;
} 
table#t02 {
  table-layout: fixed ;
  width: 40%;    
  background-color: #f1f1c1;
}
</style>
	
</head>
<body>

<h1>SMURF DETECTOR 2.0</h1>
<form action="smurfdetector.php" method="post">
 <p>SteamID: <input type="text" name="steamid" /></p>
 <p><input type="submit" value='Submit' /></p>
</form>


<?php

	include_once 'SteamFunctions-master/includes/class_lib.php';
	include_once 'config.php';
	$steamid = htmlspecialchars($_POST['steamid']); 
	
	$SteamQuery = new SteamQuery;
	$SteamIDConvert = new SteamIDConvert;
	
	mysql_connect($database['host'], $database['username'], $database['password']);
	mysql_select_db($database['database_name']);

	$ips = mysql_query("SELECT DISTINCT ip FROM $dbtable WHERE auth='$steamid' ORDER BY ip");
	$accountinfo = mysql_query ("SELECT * FROM $dbtable WHERE auth ='$steamid' ORDER BY connect_date DESC LIMIT 1");
	$accountinfodata = mysql_fetch_assoc($accountinfo);
	$lastconnect = $accountinfodata["connect_date"];
	$country = $accountinfodata["country"];
	$name = $accountinfodata["name"];
	$ipcount = mysql_num_rows($ips);

	$smurflist = array();	
	while($ipdata = mysql_fetch_assoc($ips))
	{
		$ip = $ipdata["ip"];	
	    $smurfs = mysql_query("SELECT DISTINCT auth FROM $dbtable WHERE ip='$ip' ORDER BY auth");

		while($smurfdata = mysql_fetch_assoc($smurfs))
		{
			$smurf = $smurfdata["auth"];
			if ($smurf != "$steamid") 
			array_push($smurflist, $smurf);				// jede steamid in array schreiben
		}		
	}

	echo "<br>";

	$clearlist = array_unique ($smurflist);		// doppelte einträge löschen
	$SteamArray = $SteamIDConvert->SteamIDCheck($steamid);
	$profilelink = $SteamArray['steam_link'];
	
	echo "<h3>Checked account: <br></h3>";
	echo "<table id=t01>";
    echo "<tr>";
    echo "<th style=width:10%>SteamID</th>";
    echo "<th style=width:14%>Name</th>"; 
    echo "<th style=width:8%>Last connect date</th>";
	echo "<th style=width:8%>Country</th>";
	echo "<th style=width:8%>IP's found</th>";
	echo "</tr>";
	echo "<tr>";
    echo "<td><a href='$profilelink' target=_blank>$steamid</a></td>";
	echo "<td>$name</td>"; 
	echo "<td>$lastconnect</td>";
	echo "<td>$country</td>";
	echo "<td>$ipcount</td>";
	echo "</tr>";
	echo "</table>";

	echo "<br>";
	echo "<br>";
	
	echo "<h3>".count($clearlist)." smurf account(s) found<br></h3>";
	echo "<table id=t02>";
    echo "<tr>";
    echo "<th style=width:10%>SteamID</th>";
    echo "<th style=width:14%>Name</th>"; 
    echo "<th style=width:8%>Last connect date</th>";
	echo "<th style=width:8%>Country</th>";
	echo "</tr>";
	foreach($clearlist as $psmurfs)
	{
		$SteamArray = $SteamIDConvert->SteamIDCheck($psmurfs);
		$profilelink = $SteamArray['steam_link'];
		
		$smurfinfo = mysql_query ("SELECT * FROM $dbtable WHERE auth = '$psmurfs' ORDER BY connect_date DESC LIMIT 1");
		$smurfinfodata = mysql_fetch_assoc($smurfinfo);
		$lastconnect = $smurfinfodata["connect_date"];
		$country = $smurfinfodata["country"];
		$name = $smurfinfodata["name"];
		
		echo "<tr>";
        echo "<td><a href='$profilelink' target=_blank>$psmurfs</a></td>";
		echo "<td>$name</td>"; 
		echo "<td>$lastconnect</td>";
		echo "<td>$country</td>";
		echo "</tr>";
	}
	echo "</table>";
	
	echo "<br>";
	echo "<br>";

?>

 © <?php
$copyYear = 2018; // Set your website start date
$curYear = date('Y'); // Keeps the second year updated
echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
?> nap

</body>	
</html>