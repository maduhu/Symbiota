<?php
	include_once('../../../config/dbconnection.php');
	$retArr = Array();
	$con = MySQLiConnectionFactory::getCon("readonly");
	$occurrenceId = $con->real_escape_string($_REQUEST['oi']);
	$collId = $con->real_escape_string($_REQUEST['collid']);
	
	if($occurrenceId && $collId){
		$sql = 'SELECT occid FROM omoccurrences WHERE occurrenceid = "'.$occurrenceId.'" AND collid = '.$collId.' ';
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