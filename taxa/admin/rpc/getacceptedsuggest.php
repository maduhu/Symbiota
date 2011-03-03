<?php
include_once('../../../config/symbini.php');
include_once($serverRoot.'/config/dbconnection.php');
header("Content-Type: text/html; charset=".$charset);
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

//get the q parameter from URL
$q = $_REQUEST['q'];
$taxAuthId = array_key_exists('taid',$_REQUEST)?$_REQUEST['taid']:'1'; 

$retArr = Array();
$con = MySQLiConnectionFactory::getCon("readonly");
$sql = 'SELECT t.tid, t.sciname FROM taxa t INNER JOIN taxstatus ts ON t.tid = ts.tid '.
	'WHERE (ts.taxauthid = '.$taxAuthId.') AND (ts.tid = ts.tidaccepted) AND (t.sciname LIKE "'.$q.'%") ORDER BY t.sciname LIMIT 10';
$result = $con->query($sql);
while($row = $result->fetch_object()){
	$retArr[] = $row->sciname;
}
$result->close();
if(!($con === false)) $con->close();

//output the response
echo "['".implode("','",$retArr)."']";
?>