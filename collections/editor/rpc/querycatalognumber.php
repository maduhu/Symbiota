<?php
	include_once('../../../config/dbconnection.php');
	$retArr = Array();
	$con = MySQLiConnectionFactory::getCon("readonly");
	$catNum = $con->real_escape_string($_REQUEST['cn']);
	$collId = $con->real_escape_string($_REQUEST['collid']);
	
	if($catNum && $collId){
		$sql = 'SELECT occid FROM omoccurrences WHERE catalognumber = "'.$catNum.'" AND collid = '.$collId.' ';
		//echo $sql;
		$result = $con->query($sql);
		while ($row = $result->fetch_object()) {
			$retArr[] = $row->occid;
		}
		$result->close();
	}
	$con->close();
	echo json_encode($retArr);
?>