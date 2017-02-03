<?php
class sql
{
	function getTurnierByYear($year)
	{
		$tsb = mktime(0,0,0,1,1,$year);
		$tse = mktime(0,0,0,12,31,$year);

		$sql = "SELECT * FROM tx_sjshgrandprix_gp_turnier where turnier_date > $tsb AND turnier_date < $tse";
		return mysql_query($sql);
	}	
	
	function getAks()
	{
		$sql = "SELECT * FROM tx_sjshgrandprix_gp_ak";
		return mysql_query($sql);
	}
	
	function getSpielerByAK($id, $year)
	{
		$sql = "SELECT tx_sjshgrandprix_gp_spieler.uid, spieler_name, verein_name FROM tx_sjshgrandprix_gp_spieler join tx_sjshgrandprix_gp_verein on uid.uid = verein_id inner join tx_sjshgrandprix_gp_ageclasstoplayer on gp_player = tx_sjshgrandprix_gp_spieler.uid where gp_ageclass = $id and year = $year";
		return mysql_query($sql);
	}
	
	function getSpielerByuid($uid)
	{
		$sql = "SELECT tx_sjshgrandprix_gp_spieler.uid, spieler_name, spieler_vorname, verein_name FROM tx_sjshgrandprix_gp_spieler join tx_sjshgrandprix_gp_verein on tx_sjshgrandprix_gp_verein.uid = verein_id where tx_sjshgrandprix_gp_spieler.uid = $uid";
		return mysql_query($sql);
	}
	function getErgebnisByuid($spieler, $turnier)
	{
		
		$sql = "SELECT * FROM tx_sjshgrandprix_gp_punkte where spieler_id = $spieler AND turnier_id = $turnier";
		return mysql_query($sql);
	}

	
}

	
	
?>