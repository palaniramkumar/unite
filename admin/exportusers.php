<?php

require_once('../class/HealthCheck.php');

validateUser("Admin");
header("Content-type","application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=\"download.xls\"");
header("Cache-Control: max-age=0");

$host = 'unitev2.db.8799516.hostedresource.com';
$port = '3306';
$server = $host . ':' . $port;
$user = 'unitev2';
$password = 'SSNC0lleg#';

$link = mysql_connect ($server, $user, $password);
if (!$link)
{
	die('Error: Could not connect: ' . mysql_error());
}

$database = 'unitev2';

mysql_select_db($database);

$query = 'select * from alumnireg';

$result = mysql_query($query);

if (!$result) 
{
	$message = 'ERROR:' . mysql_error();
	return $message;
}
else
{
	$i = 0;
	echo '<html><body><table><tr>';
	while ($i < mysql_num_fields($result))
	{
		$meta = mysql_fetch_field($result, $i);
		echo '<td>' . $meta->name . '</td>';
		$i = $i + 1;
	}
	echo '</tr>';
	
	$i = 0;
	while ($row = mysql_fetch_row($result)) 
	{
		echo '<tr>';
		$count = count($row);
		$y = 0;
		while ($y < $count)
		{
			$c_row = current($row);
			echo '<td>' . $c_row . '</td>';
			next($row);
			$y = $y + 1;
		}
		echo '</tr>';
		$i = $i + 1;
	}
	echo '</table></body></html>';
	mysql_free_result($result);
}

mysql_close ($link);
?>