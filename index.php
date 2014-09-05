<html><body><h1>WiFi-overzicht</h1>

<?php
	shell_exec('rm /tmp/try');
	$output = shell_exec('/sbin/iwlist wlan0 scan | grep ESSID');

	$output = preg_replace('/\s+/', ' ', $output);


	$output = str_replace("ESSID:", "", $output);
	$output = str_replace('"', '', $output);
	$output = str_replace(" ","<br />", $output);

	echo "Hieronder vindt u een lijst van de in de omgeving beschikbare WiFi-netwerken:";
	echo "<br />";
	echo "$output";

?>
<br />
<form action="#" method="post">

SSID: <input type="text" name="ssid"><br />
Password: <input type="text" name="password"><br />
<input type="submit" name="submit" value="Voeg toe">
</form>

<?php

	$ssid = $_POST["ssid"];
	$pass = $_POST["password"];
//	$file = "/home/pi/test123.txt";

	$a = "network={";
	$b = "ssid=\"$ssid\"";
	$c = "key_mgmt=WPA-PSK";
	$d = "psk=\"$pass\"";
	$e = "}";


	if ($ssid != "" && $pass != "") {

		$current = file_get_contents('/home/pi/test123.txt', FILE_USE_INCLUDE_PATH);
		$current = $current . " " . $a;
		echo "$current";
		file_put_contents('/home/pi/test123.txt', $current, FILE_APPEND | FILE_USE_INCLUDE_PATH);
		shell_exec('sudo echo ' .$a. ' >> /home/pi/test123.txt');
		shell_exec('echo ' .$b. ' >> /home/pi/test123.txt');
		shell_exec('echo ' .$c. ' >> /tmp/try');
		shell_exec('echo ' .$d. ' >> /tmp/try');
		shell_exec('echo ' .$e. ' >> /tmp/try');
//		shell_exec('echo ' .$ssid. ' ' .$pass. ' >> /tmp/password');
	}
?>


</body>
</html>

