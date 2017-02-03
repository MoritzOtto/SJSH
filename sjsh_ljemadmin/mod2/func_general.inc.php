<?php
define ("db_spieler", "tx_sjshljemadmin_spieler");
define("db_ergebnisse", "tx_sjshljemadmin_ergebnisse");
define("db_aks", "tx_sjshljemadmin_aks");     
define("JAHR", 2011);

function updateTabelle($ak) {
	$runde = grunde($ak);
	echo $runde;
	// punkte, siege
	$result = $GLOBALS['TYPO3_DB']->sql_query("SELECT * FROM ".db_spieler." WHERE uid > '".($ak*100)."' AND uid < '".($ak*100+100)."'");
	while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)) {
		$srow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(erg1) a FROM ".db_ergebnisse." WHERE id1 = '".$row['uid']."' AND erg1 = '1' AND runde <= '$runde'"));
		$s = $srow['a'];
		$srow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(erg2) a FROM ".db_ergebnisse." WHERE id2 = '".$row['uid']."' AND erg2 = '1' AND runde <= '$runde'"));
		$s += $srow['a'];
		
		$rrow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(erg1) a FROM ".db_ergebnisse." WHERE id1 = '".$row['uid']."' AND erg1 = '0.5' AND runde <= '$runde'"));
		$r = $rrow['a'];
		$rrow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(erg2) a FROM ".db_ergebnisse." WHERE id2 = '".$row['uid']."' AND erg2 = '0.5' AND runde <= '$runde'"));
		$r += $rrow['a'];
		
		$vrow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(erg1) a FROM ".db_ergebnisse." WHERE id1 = '".$row['uid']."' AND erg1 = '0' AND runde <= '$runde'"));
		$v = $vrow['a'];
		$vrow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(erg2) a FROM ".db_ergebnisse." WHERE id2 = '".$row['uid']."' AND erg2 = '0' AND runde <= '$runde'"));
		$v += $vrow['a'];

echo "Spieler".$row['name'];
 echo "Spieler".$row['uid'];
echo "SSSS".$s;		
echo "RRRR".$r;	
echo "VVVV".$v;	
		
		//Kampflose für die BuchholzPunkte
		$klrow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(*) a from ".db_ergebnisse."  WHERE id1 = '".$row['uid']."' AND erg1 = '1' AND runde <= '$runde' AND flag = 1"));
		$kls = $klrow['a'];
		$kllrow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(*) a from ".db_ergebnisse."  WHERE id1 = '".$row['uid']."' AND erg1 = '0' AND runde <= '$runde' AND flag = 1"));
		$kll = $kllrow['a'];
		$klrow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(*) a from ".db_ergebnisse."  WHERE id2 = '".$row['uid']."' AND erg1 = '1' AND runde <= '$runde' AND flag = 1"));
		$kls = $kls + $klrow['a'];
		$kllrow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(*) a from ".db_ergebnisse."  WHERE id2 = '".$row['uid']."' AND erg1 = '0' AND runde <= '$runde' AND flag = 1"));
		$kll = $kll + $kllrow['a'];

		
	$kls = $kls * 0.5;
  $kll = $kll * 0.5;
  
		$punkte = $s + $r/2;
		
	$buchPt = $punkte;
  $buchPt = $buchPt - $kls;
  $buchPt = $buchPt + $kll;	
		$cntRow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(*) a FROM ".db_ergebnisse." WHERE (id1 = '".$row['uid']."' OR id2 = '".$row['uid']."') AND runde <= '$runde'"));
		$cnt = $cntRow['a'];
						        
        if($cnt < $runde)
        {
            $not = $runde - $cnt;
            $buchPt = $buchPt + $not * 0.5;

        }
        
		
		
		$GLOBALS['TYPO3_DB']->sql_query("UPDATE ".db_spieler." SET punkte = '$punkte', s = '$s', r = '$r', v = '$v', punktebuch = '$buchPt' WHERE uid = '".$row['uid']."' LIMIT 1");

	}
	
	// feinwertung
	$result = $GLOBALS['TYPO3_DB']->sql_query("SELECT * FROM ".db_spieler." WHERE uid > '".($ak*100)."' AND uid < '".($ak*100+100)."'");
	while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)) {
	
		$buch = 0;
		$soberg = 0;

		
		$res = $GLOBALS['TYPO3_DB']->sql_query("SELECT * FROM ".db_ergebnisse." WHERE (id1 = '".$row['uid']."' OR id2 = '".$row['uid']."') AND runde <= '$runde' AND flag = 0");
		         
		while ($ro = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {

			if ($ro['id2'] == $row['uid']) { // weiss aufaddieren
				  
          $temp = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT punktebuch FROM ".db_spieler." WHERE uid = '".$ro['id1']."' LIMIT 0,1"));
          
					$buch += $temp['punktebuch'];
				  $soberg += $ro['erg2'] * $temp['punktebuch'];
				  
				  

			} elseif ($ro['id1'] == $row['uid']) { // schwarz aufaddieren
				$temp = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT punktebuch FROM ".db_spieler." WHERE uid = '".$ro['id2']."' LIMIT 0,1"));

  				$buch += $temp['punktebuch'];
  				$soberg += $ro['erg1'] * $temp['punktebuch'];				
			}
 		}
		
		
		      $i = 0;
		      $l = 0;
		      
		while($i < $runde)
		{
		     $i++;
		  $kls = 0;
		  $kll = 0;
      $c = 0;
      $cRow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(*) a FROM ".db_ergebnisse." WHERE (id1 = '".$row['uid']."' OR id2 = '".$row['uid']."') AND runde = '$i'"));
		  $c = $cRow['a'];
		  

		$klrow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(*) a from ".db_ergebnisse."  WHERE id1 = '".$row['uid']."' AND erg1 = '1' AND runde <= '$i' AND flag = 1"));
		$kls = $klrow['a'];
		$kllrow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(*) a from ".db_ergebnisse."  WHERE id1 = '".$row['uid']."' AND erg1 = '0' AND runde <= '$i' AND flag = 1"));
		$kll = $kllrow['a'];
		$klrow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(*) a from ".db_ergebnisse."  WHERE id2 = '".$row['uid']."' AND erg1 = '1' AND runde <= '$i' AND flag = 1"));
		$kls = $kls + $klrow['a'];
		$kllrow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(*) a from ".db_ergebnisse."  WHERE id2 = '".$row['uid']."' AND erg1 = '0' AND runde <= '$i' AND flag = 1"));
		$kll = $kll + $kllrow['a'];
		
				$srow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(erg1) a FROM ".db_ergebnisse." WHERE id1 = '".$row['uid']."' AND erg1 = '1' AND runde <= '$i'"));
		$sc = $srow['a'];
		$srow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(erg2) a FROM ".db_ergebnisse." WHERE id2 = '".$row['uid']."' AND erg2 = '1' AND runde <= '$i'"));
		$sc += $srow['a'];
		
		$rrow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(erg1) a FROM ".db_ergebnisse." WHERE id1 = '".$row['uid']."' AND erg1 = '0.5' AND runde <= '$i'"));
		$rc = $rrow['a'];
		$rrow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT COUNT(erg2) a FROM ".db_ergebnisse." WHERE id2 = '".$row['uid']."' AND erg2 = '0.5' AND runde <= '$i'"));
		$rc += $rrow['a'];
		
		

		$ptcurr = $sc + $rc/2;
		   
      if($c == 0)
      {
        $l++;
         $k = ($runde-$i)*0.5;
         
         $buch = $buch+$ptcurr+$k+1; 
      }  

		  if($kls > 0)
      {
        $l++;
         $k = ($runde-$i)*0.5;
         
         $buch = $buch+$ptcurr+$k;
         $soberg = $soberg+$ptcurr+$k;  
      }
      
      if($kll > 0)
      {
        $l++;
         $k = ($runde-$i)*0.5;
         
         $buch = $buch+$ptcurr+$k+1; 
      }

    }
    
    $BuchSumW = $GLOBALS['TYPO3_DB']->sql_query("SELECT * FROM ".db_ergebnisse." WHERE id1 = '".$row['uid']."' AND runde <= '$runde'");
    $buchsum=0;
    
    		while($white = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($BuchSumW))
    		{

            $x = $GLOBALS['TYPO3_DB']->sql_query("SELECT * FROM ".db_spieler." where uid = ".$white['id2']);
           $r = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($x);

           $buchsum = $buchsum +  $r['buch'];
        }
    		
    		$BuchSumB = $GLOBALS['TYPO3_DB']->sql_query("SELECT * FROM ".db_ergebnisse." WHERE id2 = '".$row['uid']."' AND runde <= '$runde'");
    		while($black = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($BuchSumB))
    		{
             $x = $GLOBALS['TYPO3_DB']->sql_query("SELECT * FROM ".db_spieler." where uid = ".$black['id1']);
           $r = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($x);
           $buchsum = $buchsum +  $r['buch'];
        }

          
		
		$GLOBALS['TYPO3_DB']->sql_query("UPDATE ".db_spieler." SET buch = '$buch', soberg = '$soberg', buchsum='$buchsum' WHERE uid = '".$row['uid']."' LIMIT 1");
	}
	$tempSql = "SELECT * FROM ".db_aks." WHERE uid = ".$ak;
	echo $tempSql;
	$sq = $GLOBALS['TYPO3_DB']->sql_query($tempSql);
	
  $rowak = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($sq);
	
	echo "ROWAK Modus:". $rowak['modus'];
	
	if($rowak['modus'] == "ch")
	{
    $mod = "buch";
    $buchsum = ", buchsum DESC";
  }
  else
  {
      $mod = "soberg";
      $buchsum = "";
  }
  
  
	// rang
	$sql ="SELECT uid,punkte,buch,soberg,s, buchsum FROM ".db_spieler." WHERE uid > '".($ak*100)."' AND uid < '".($ak*100+100)."' ORDER BY punkte DESC,  $mod DESC, s DESC $buchsum"; 
	echo $sql;
  $result = $GLOBALS['TYPO3_DB']->sql_query($sql);  
	$i = 1;
	while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)) { 

		
		
			if($rowak['modus'] == "ch")
	{
		if ($prev['punkte'] == $row['punkte'] && $prev['buch'] == $row['buch'] && $prev['s'] == $row['s'] && $prev['buchsum'] == $row['buchsum'] && $rang > 0) {

		} else {
			$rang = $i;
		}
  }
  else
  {
		if ($prev['punkte'] == $row['punkte'] && $prev['soberg'] == $row['soberg'] && $prev['s'] == $row['s'] &&  $rang > 0) {

		} else {
			$rang = $i;
		}
  }
		
		
		
		$GLOBALS['TYPO3_DB']->sql_query("UPDATE ".db_spieler." SET rang = '$rang' WHERE uid = '".$row['uid']."' LIMIT 1");
		$i++;
		$prev = $row;
	}
	
	$GLOBALS['TYPO3_DB']->sql_query("OPTIMIZE TABLE ".db_spieler);
	$GLOBALS['TYPO3_DB']->sql_query("OPTIMIZE TABLE ".db_ergebnisse);
}

function grunde() {
	$ak = func_get_arg(0);
	$temp=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT runde FROM ".db_ergebnisse." WHERE klasse='".$ak."' AND (erg1>0 OR erg2>0) AND flag=0 ORDER BY runde DESC LIMIT 0,1")); 
	return $temp['runde'];
}

function gak() {
	$ak=func_get_arg (0);
	$row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT * FROM ".db_aks." WHERE uid='".$ak."' LIMIT 0,1"));
	$tempret[]=$row['u'];
	if(func_num_args()==2){
		//Attribut?
		if($row['attribut']=="m") $tempret[]="m";
		elseif($row['attribut']=="v") $tempret[]="v";
		//Staffel
		if($row['staffel']!="") $tempret[]=$row['staffel'];
		return implode("",$tempret);
	} else{
		//Attribut?
		if($row['staffel']=="w") $tempret[]="M&auml;dchen";
		elseif($row['staffel']=="m") $tempret[]="Meister";
		elseif($row['staffel']=="v") $tempret[]="Vormeister";
	  elseif($row['staffel']=="W") $tempret[]="M&auml;dchen";
		elseif($row['staffel']=="M") $tempret[]="Meister";
		elseif($row['staffel']=="V") $tempret[]="Vormeister";
		//Staffel
		//if($row['staffel']!="") $tempret[]=ucfirst($row['staffel']);
		return implode(" ",$tempret);
	}
}
	
function ekampflos($erg){

  if($erg == 1) return '+';
  if($erg == 0) return '-';
  return '';
	}
function eergebnis($erg){
	$rep1=array("!^1\.0$!","!^0\.5$!","!^0\.0$!");
	$rep2=array("1","&frac12;","0");
	return preg_replace($rep1,$rep2,$erg);
	}
?>