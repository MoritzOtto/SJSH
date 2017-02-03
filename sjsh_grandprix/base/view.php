<?php
require_once('sql.php');
class view
{
	
	function buildOverview($year)
	{
		$content = "
		<table width='90%'>
		  <tr bgcolor='#FF9999' bordercolor='#000000'> 
		    <td width='15%'> 
		      <div align='center'><b>Monat</b></div>
		    </td>
		    <td width='17%'> 
		      <div align='center'><b>Veranstalter</b></div>
		    </td>
		
		    <td width='11%'> 
		      <div align='center'><b>Ort</b></div>
		    </td>
		    <td width='9%'> 
		      <div align='center'><b>Datum</b></div>
		    </td>
		
		    <td width='12%'> 
		      <div align='center'><b>Ergebnisse</b></div>
		    </td>
		    <td width='20%'> 
		      <div align='center'><b>Ausschreibung</b></div>
		    </td>
		  </tr>
		";
		
		$db = new sql();

		$do = $db->getTurnierByYear($year);
		while($row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($do))
		{
		$month = date("F Y", $row["turnier_date"]);
		$trans = array(
		    'Monday'    => 'Montag',
		    'Tuesday'   => 'Dienstag',
		    'Wednesday' => 'Mittwoch',
		    'Thursday'  => 'Donnerstag',
		    'Friday'    => 'Freitag',
		    'Saturday'  => 'Samstag',
		    'Sunday'    => 'Sonntag',
		    'Mon'       => 'Mo',
		    'Tue'       => 'Di',
		    'Wed'       => 'Mi',
		    'Thu'       => 'Do',
		    'Fri'       => 'Fr',
		    'Sat'       => 'Sa',
		    'Sun'       => 'So',
		    'January'   => 'Januar',
		    'February'  => 'Februar',
		    'March'     => 'M&auml;rz',
		    'May'       => 'Mai',
		    'June'      => 'Juni',
		    'July'      => 'Juli',
		    'October'   => 'Oktober',
		    'December'  => 'Dezember',
		);
			$month = strtr($month, $trans);
			$date = date("d.m.Y", $row["turnier_date"]);
		  $content = $content.
		  "<tr>
			<td height='23' bgcolor='#FFFFCC' width='15%'><b>$month</b></td>
			<td height='23' width='17%'>".$row["turnier_veranstalter"]."</td>
			<td height='23' width='11%'>".$row["turnier_ort"]."</td>
			<td height='23' width='9%'>".$date."</td>";
			if($row["turnier_ergebnisse"])
			{
			$content = $content."<td height='23' width='12%'><a href='".$row["turnier_ergebnisse"]."' target='_blank'>Ergebnis</a></td>";
			}
			else
			{
			$content = $content."<td></td>"	;
			}
			if($row["turnier_ausschreibung"])
			{
			$content = $content."<td height='23' width='20%'><a href='".$row["turnier_ausschreibung"]."' target='_blank'>Ausschreibung</a></td>";
			}
			else
			{
			$content = $content."<td></td>"	;
			}
			
		  $content = $content."</tr>";
	
		}
		$content=$content."</Table>";
		
		
		
		
		return $content;
	}


	function buildTable($year)
	{
		$db = new sql();
		$do = $db->getAks();
		
		$content = "<h2>Grand Prix ".$year."</h2><br>";
		while($aks = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($do))
		{
			$content = $content."
			<h3>".$aks["ak_name"]."</h3>
			<table>
			<tr>
			<td></td>
			<td></td>
			<td>Nr:<br>Ort<br>Datum:</td>
			";
			$arr = null;
			$i = 0;
			$do1 = $db->getTurnierByYear($year);
			   
			while($tmt = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($do1))
			{
				$date = date("d.m.Y", $tmt["turnier_date"]);
				$i++;
				$content = $content."<td align='center'>".$i."<br>".$tmt["turnier_ort"]."<br>".$date."</td>";
				$arr[] = $tmt;
			}
			
			
			
			$content = $content."<td>Gesamt</td></tr>";
			
			$do3 = $db->getSpielerByAK($aks["uid"], $year);
				
			$spielerarray = $this->getGPTabelle($do3, $arr);
				
				
			$Platz = 0;
			foreach($spielerarray as $sa)
			{
				if($sa['pt'] == 0)
					break;
				  
				$do4 = $db->getSpielerByID($sa['id']);
				$spie = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($do4);
				$Platz++;
				
				if($Platz==1)
				{
				$content = $content."<tr><td><b>$Platz.</b></td><td><b>".$spie["spieler_name"].", ".$spie["spieler_vorname"]."</b></td><td><b>".$spie["verein_name"]."</b></td>";
				}
				else
				{
				$content = $content."<tr><td>$Platz.</td><td>".$spie["spieler_name"].", ".$spie["spieler_vorname"]."</td><td>".$spie["verein_name"]."</td>";
				}
			
				
				foreach($arr as $a)
				{
					$done = $db->getErgebnisById($spie["uid"], $a["uid"]);
					$erg = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($done);
					
					$content = $content."<td align='center'>".$erg["punkte"]."</td>";
					
				}
				$content = $content."<td align='center'><b>".$sa['pt']."</b></td></tr>";
			}
			
			
			
			
			
			$content = $content."
			</table>
			";
			
		}

		return $content;
	}	
	function getGPTabelle($do, $arr)
	{
		$db = new sql();
				$pt = 0;
			$j = 0;
			$spielerarray = array();
			$pkte = array();
			$id = array();
			
			while($spi = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($do))
			{
				$ergs = array();
				foreach($arr as $a)
				{
								   
					$done = $db->getErgebnisById($spi["uid"], $a["uid"]);
					$erg = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($done);
					
					$ergs[] = $erg["punkte"];
				}
				arsort($ergs);
				$pt = 0;
				$male = 0;
				foreach($ergs as $e)
				{
					$male ++;
					if($male <= 5)
					{
					$pt = $pt + $e;
					}
				}
				
				
				$spielerarray[] = array('id' => $spi["uid"], 'pt' => $pt);

				
				$j++;
			}
			
			foreach ($spielerarray as $key => $r) {
   			 $id[$key] = $r['uid'];
    			 $pkte[$key] = $r['pt'];
			}


			array_multisort($pkte, SORT_DESC, $id, SORT_ASC, $spielerarray);
			
			return 	$spielerarray;
	}
	
	
		function buildFirstPlace($year)
	{
		$db = new sql();
		$do = $db->getAks();
		
		$content = "<h5>Erstplatzierte</h5><table>";
		while($aks = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($do))
		{

			$arr = null;
			$i = 0;
			$do1 = $db->getTurnierByYear($year);
			
			$content = $content. "<tr><td width='30'>".$aks["ak_name"]."</td>"   ;
			
			while($tmt = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($do1))
			{
				$i++;
				$arr[] = $tmt;
			}

			
			$do3 = $db->getSpielerByAK($aks["uid"], $year);
				
			$spielerarray = $this->getGPTabelle($do3, $arr);
				
				
			$Platz = 0;
			foreach($spielerarray as $sa)
			{
				if($sa['pt'] == 0)
					break;
				
				$do4 = $db->getSpielerByID($sa['id']);
				$spie = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($do4);
				$Platz++;
				
				if($Platz==1)
				{
				$content = $content."<td width='150'>".$spie["spieler_vorname"]." ". $spie["spieler_name"]."</td><td align='center'><b>".$sa['pt']."</b></td></tr>";
				}

			}

		}
		
		     			$content = $content."
			</table>
			";
		
		
		
		return $content;
		}
	
	
	
}


?>
