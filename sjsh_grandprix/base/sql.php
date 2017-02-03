<?php
class sql
{
	function getTurnierByYear($year)
	{
		$tsb = mktime(0,0,0,1,1,$year);
		$tse = mktime(0,0,0,12,31,$year);

		$sql = "SELECT * FROM tx_sjshgrandprix_gp_Turnier where deleted = 0 AND turnier_date > $tsb AND turnier_date < $tse order by turnier_date";
		return $GLOBALS['TYPO3_DB']->sql_query($sql);
	}	
	
	function getAks()
	{
		$sql = "SELECT * FROM tx_sjshgrandprix_gp_AK where deleted = 0";
		return $GLOBALS['TYPO3_DB']->sql_query($sql);
	}
	
	function getSpielerByAK($id, $year)
	{
		$sql = "SELECT tx_sjshgrandprix_gp_Spieler.uid, spieler_name, verein_name FROM tx_sjshgrandprix_gp_Spieler join tx_sjshgrandprix_gp_Verein on tx_sjshgrandprix_gp_Verein.uid = verein_id inner join tx_sjshgrandprix_gp_AgeClassToPlayer on gp_player = tx_sjshgrandprix_gp_Spieler.uid where tx_sjshgrandprix_gp_Verein.deleted = 0 AND tx_sjshgrandprix_gp_Spieler.deleted = 0 AND gp_ageclass = $id and year = $year";
		return $GLOBALS['TYPO3_DB']->sql_query($sql);
	}
	
	function getSpielerByID($uid)
	{
		$sql = "SELECT tx_sjshgrandprix_gp_Spieler.uid, spieler_name, spieler_vorname, verein_name FROM tx_sjshgrandprix_gp_Spieler join tx_sjshgrandprix_gp_Verein on tx_sjshgrandprix_gp_Verein.uid = verein_id where tx_sjshgrandprix_gp_Verein.deleted = 0 AND tx_sjshgrandprix_gp_Spieler.deleted = 0 AND tx_sjshgrandprix_gp_Spieler.uid = $uid";
		return $GLOBALS['TYPO3_DB']->sql_query($sql);
	}
	function getErgebnisById($spieler, $turnier)
	{
		
		$sql = "SELECT * FROM tx_sjshgrandprix_gp_Punkte where deleted = 0 AND spieler_id = $spieler AND turnier_id = $turnier";
		return $GLOBALS['TYPO3_DB']->sql_query($sql);
	}

	
}

	
	
?>