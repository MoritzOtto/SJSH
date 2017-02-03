<?php
class databaseDates
{
	
	function selectdates()
	{
		$ts = time();

		$sql = "Select name, ausrichter, begin, end, location, url from tx_sjshdates_tbldates where end > $ts AND deleted = 0 AND hidden = 0 order by begin";
		$do = $GLOBALS['TYPO3_DB']->sql_query($sql);
		
		return $do;
	}
	function getnextsh()
	{
		$ts = time();
		$date = date("d.m.Y",$ts);	
		$sql = "Select begin, name, url from tx_sjshdates_tbldates where sh = true and end > $date AND deleted = 0 AND hidden = 0 ORDER by begin";
		$do = $GLOBALS['TYPO3_DB']->sql_query($sql);
		
		return $do;
	}
	function insernew($name, $ausrichter, $begin, $end, $location, $url, $sh, $user)
	{
		
		$SQL = "insert into tx_sjshdates_tbldates(name, ausrichter, begin, end, location, url, sh, general_user) VALUES ('$name', '$ausrichter', '$begin', '$end', '$location', '$url', '$sh', '$user')";
		$do = $GLOBALS['TYPO3_DB']->sql_query($SQL);
	}
}
?>