<?php
namespace SJSH\sjshgpadmin\Domain\Repository; 

use SJSH\sjshgpadmin\Domain\Model;

class DatabaseServices {
	public function getAks()
	{
		$sql = "SELECT * FROM tx_sjshgrandprix_gp_AK";
		$do =  $GLOBALS['TYPO3_DB']->sql_query($sql);
		while($ak = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($do))
		{
			$aks[] = $ak["ak_name"];
		}
		
		return $aks;
	}
	
	public function getTurnierByYear($year)
	{
		$tsb = mktime(0,0,0,1,1,$year);
		$tse = mktime(0,0,0,12,31,$year);

		$sql = "SELECT * FROM tx_sjshgrandprix_gp_Turnier where turnier_date > $tsb AND turnier_date < $tse order by turnier_date";
		$do = $GLOBALS['TYPO3_DB']->sql_query($sql);
		
		while($tournamentdb = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($do))
		{
			$tournament = new \SJSH\sjshgpadmin\Domain\Model\Tournament();
			$tournament->id = $tournamentdb["uid"];
			$tournament->name = $tournamentdb["turnier_ort"];
			$tournaments[] = $tournament;
		}
		
		return $tournaments;
	}
	
	public function getTurnierById($id)
	{
		$sql = "SELECT * FROM tx_sjshgrandprix_gp_Turnier where uid = $id";
		$do = $GLOBALS['TYPO3_DB']->sql_query($sql);
		
		while($tournamentdb = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($do))
		{
			$tournament = new \SJSH\sjshgpadmin\Domain\Model\Tournament();
			$tournament->id = $tournamentdb["uid"];
			$tournament->name = $tournamentdb["turnier_ort"];
		}
		
		return $tournament;
	}
	
	public function InsertClubIfNotExists($player)
	{
		$clubId = $this->getClubid($player->club);
		
		if(isset($clubId))
		{
			return;
		}
		
		$sql = "INSERT IGNORE INTO tx_sjshgrandprix_gp_Verein SET verein_name = '".$player->club."'";
		$do = $GLOBALS['TYPO3_DB']->sql_query($sql);
	}
	
	public function InsertPlayerIfNotExists($player)
	{
		$spielerId = $this->getPlayerId($player);
		
		if(isset($spielerId))
		{
			return;
		}
		
		$sql = "INSERT IGNORE INTO tx_sjshgrandprix_gp_Spieler SET spieler_name = '".$player->lastname."', spieler_vorname ='".$player->firstname."'";
		$do = $GLOBALS['TYPO3_DB']->sql_query($sql);
	}
	
	public function UpdateClub($player)
	{
		$clubId = $this->getClubid($player->club);
		
		$sql = "UPDATE tx_sjshgrandprix_gp_Spieler SET verein_id = ".$clubId." WHERE spieler_name = '".$player->lastname."' AND spieler_vorname ='".$player->firstname."'";
		$do = $GLOBALS['TYPO3_DB']->sql_query($sql);
	}
	
	public function InsertAgeClassToPlyerIfNotExists($player, $year)
	{
		$playerID = $this->getPlayerId($player);
		$akId = $this->getAkId($player->ageclass);
		
		$ak2Player = $this->getAkToPlayerId($akId, $playerID, $year);
		
		if(isset($ak2Player))
		{
			return;
		}
		
		echo "akid". $akId;
		echo "playerID". $playerID;
		echo "year". $year;
		
		
		$sql = "INSERT IGNORE INTO tx_sjshgrandprix_gp_AgeClassToPlayer SET gp_ageclass = ".$akId.", gp_player = ".$playerID.", year = ".$year;
		$do = $GLOBALS['TYPO3_DB']->sql_query($sql);
	}
	
	public function InsertOrUpdatePoints($player, $placeObject, $tournamentId)
	{
		//$pointId = $this->getUid("SELECT uid FROM tx_sjshgrandprix_gp_Punkte where turnier_id = ".$tournamentId->id." AND punkte = ".$placeObject->points);
		$spielerId = $this->getPlayerId($player);
		
		if(isset($pointId))
		{
			$sql = "UPDATE tx_sjshgrandprix_gp_Punkte SET spieler_id = ".$spielerId. " WHERE turnier_id = ".$tournamentId->id." AND punkte = ".$placeObject->points;
		}
		else
		{
			$sql = "INSERT INTO tx_sjshgrandprix_gp_Punkte(spieler_id, turnier_id, punkte) VALUES(".$spielerId.", ".$tournamentId->id.", ".$placeObject->points.")";
		}
		$do = $GLOBALS['TYPO3_DB']->sql_query($sql);
	}
	
	private function getClubid($name)
	{
		$sql = "SELECT uid FROM tx_sjshgrandprix_gp_Verein where verein_name = '".$name."'";
		return $this->getUid($sql);
	}
	
	private function getAkId($name)
	{
		$sql = "SELECT uid FROM tx_sjshgrandprix_gp_AK where ak_name = '".$name."'";
		return $this->getUid($sql);
	}
	
	private function getAkToPlayerId($akId, $playerId, $year)
	{
		$sql = "SELECT uid FROM tx_sjshgrandprix_gp_AgeClassToPlayer where gp_ageclass = ".$akId." AND gp_player = ".$playerId." AND year = ".$year;
		return $this->getUid($sql);
	}
	
	private function getPlayerId($player)
	{
		$sql = "SELECT uid FROM tx_sjshgrandprix_gp_Spieler where spieler_name = '".$player->lastname."' AND spieler_vorname ='".$player->firstname."'";
		return $this->getUid($sql);
	}
	
	private function getUid($sql)
	{
		$do = $GLOBALS['TYPO3_DB']->sql_query($sql);
		while($id = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($do))
		{
			$uid = $id["uid"];
		}
		
		return $uid;
	}
}
?>