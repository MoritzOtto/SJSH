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
		while($row=mysql_fetch_object($do))
		{
		$month = date("F Y", $row->turnier_date);
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
		    'March'     => 'März',
		    'May'       => 'Mai',
		    'June'      => 'Juni',
		    'July'      => 'Juli',
		    'October'   => 'Oktober',
		    'December'  => 'Dezember',
		);
			$month = strtr($month, $trans);
			$date = date("d.m.Y", $row->turnier_date);
		  $content = $content.
		  "<tr>
			<td height='23' bgcolor='#FFFFCC' width='15%'><b>$month</b></td>
			<td height='23' width='17%'>$row->turnier_veranstalter</td>
			<td height='23' width='11%'>$row->turnier_ort</td>
			<td height='23' width='9%'>$date</td>";
			if($row->Turnier_Ergebnisse)
			{
			$content = $content."<td height='23' width='12%'><a href='$row->turnier_ergebnisse' target='_blank'>Ergebnis</a></td>";
			}
			else
			{
			$content = $content."<td></td>"	;
			}
			if($row->turnier_ausschreibung)
			{
			$content = $content."<td height='23' width='20%'><a href='$row->Turnier_Ausschreibung' target='_blank'>Ausschreibung</a></td>";
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
		while($aks = mysql_fetch_object($do))
		{
			$content = $content."
			<h3>".$aks->ak_name."</h3>
			<table>
			<tr>
			<td></td>
			<td></td>
			<td>Nr:<br>Ort<br>Datum:</td>
			";
			$arr = null;
			$i = 0;
			$do1 = $db->getTurnierByYear($year);
			
			while($tmt = mysql_fetch_object($do1))
			{
				$date = date("d.m.Y", $tmt->turnier_date);
				$i++;
				$content = $content."<td align='center'>".$i."<br>".$tmt->turnier_ort."<br>".$date."</td>";
				$arr[] = $tmt;
			}
			
			
			
			$content = $content."<td>Gesamt</td></tr>";
			
			$do3 = $db->getSpielerByAK($aks->id);
				
			$spielerarray = $this->getGPTabelle($do3, $arr);
				
				
			$Platz = 0;
			foreach($spielerarray as $sa)
			{
				if($sa['pt'] == 0)
					break;
				
				$do4 = $db->getSpielerByID($sa['id']);
				$spie = mysql_fetch_object($do4);
				$Platz++;
				
				if($Platz==1)
				{
				$content = $content."<tr><td><b>$Platz.</b></td><td><b>$spie->spieler_name, $spie->spieler_vorname</b></td><td><b>$spie->verein_name</b></td>";
				}
				else
				{
				$content = $content."<tr><td>$Platz.</td><td>$spie->spieler_name, $spie->spieler_vorname</td><td>$spie->verein_name</td>";
				}
			
				
				foreach($arr as $a)
				{
					
					$done = $db->getErgebnisById($spie->id, $a->id);
					$erg = mysql_fetch_object($done);
					
					$content = $content."<td align='center'>".$erg->punkte."</td>";
					
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
		$db = new SQL();
				$pt = 0;
			$j = 0;
			$spielerarray = array();
			$pkte = array();
			$id = array();
			
			while($spi = mysql_fetch_object($do))
			{
				$ergs = array();
				foreach($arr as $a)
				{
					
					$done = $db->getErgebnisById($spi->id, $a->id);
					$erg = mysql_fetch_object($done);
					
					$ergs[] = $erg->Punkte;
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
				
				
				$spielerarray[] = array('id' => $spi->id, 'pt' => $pt);

				
				$j++;
			}
			
			foreach ($spielerarray as $key => $r) {
   			 $id[$key] = $r['id'];
    			 $pkte[$key] = $r['pt'];
			}


			array_multisort($pkte, SORT_DESC, $id, SORT_ASC, $spielerarray);
			
			return 	$spielerarray;
	}
	
	
		function buildFirstPlace($year)
	{
		$db = new sql();
		$do = $db->getAks();
		
		$content = "<h3>Erstplatzierte</h3><table>";
		while($aks = mysql_fetch_object($do))
		{

			$arr = null;
			$i = 0;
			$do1 = $db->getTurnierByYear($year);
			
			$content = $content. "<tr><td width='30'>".$aks->ak_name."</td>"   ;
			
			while($tmt = mysql_fetch_object($do1))
			{
				$i++;
				$arr[] = $tmt;
			}

			
			$do3 = $db->getSpielerByAK($aks->id);
				
			$spielerarray = $this->getGPTabelle($do3, $arr);
				
				
			$Platz = 0;
			foreach($spielerarray as $sa)
			{
				if($sa['pt'] == 0)
					break;
				
				$do4 = $db->getSpielerByID($sa['id']);
				$spie = mysql_fetch_object($do4);
				$Platz++;
				
				if($Platz==1)
				{
				$content = $content."<td width='150'>$spie->spieler_vorname $spie->spieler_name</td><td align='center'><b>".$sa['pt']."</b></td></tr>";
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
