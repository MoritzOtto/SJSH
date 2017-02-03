<h1><?php
mysql_connect('db.planet-school.de', 'm2460-3', 'ohngeisi');

require_once('func_general.inc.php');

$ak = $_GET['ak'];
$runde = $_GET['runde'];


 echo gak($ak);?>: Paarungen und Ergebnisse</h1>
<?php 
if(!isset($runde)){
	?>
<h2>Bitte Runde ausw&auml;hlen</h2>
<ol>
<?php
	$result=$GLOBALS['TYPO3_DB']->sql_query("SELECT DISTINCT runde FROM ".db_ergebnisse." WHERE klasse='".$ak."' ORDER BY runde ASC");
	while($row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)){
		?>
  <li><a href="/sjshturniere/ljem/<?php echo JAHR; ?>/<?php echo $temp['queryakarray'][$ak-1][0]."/".$row['runde'];?>/index.htm"><?php 
  	echo "Runde ".$row['runde'];?></a></li>
  <?php
  	}
?>
</ol>
<?php
	}
else{	
	?>
<h2>Runde <?php echo $runde;?></h2>
<div align="center">
<table class="col" width="95%">
  <tr>
    <th>Tisch</th>
	<th>Teilnehmer</th>
	<th>--</th>
	<th>Teilnehmer</th>
	<th><div align="center">Ergebnis</div></th>
  </tr>
<?php
	$result=$GLOBALS['TYPO3_DB']->sql_query("SELECT * FROM ".db_ergebnisse." WHERE klasse='".$ak."' AND runde='".$runde."'");
	while($row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)){
		?>
  <tr>
  <td align="center"><?php echo $row['tisch'];?></td>
  <td><a href="/sjshturniere/ljem/<?php echo JAHR; ?>/<?php 
		$tmp = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT name FROM ".db_spieler." WHERE id = '".$row['id1']."'"));
		echo $temp['queryakarray'][$ak-1][0]."/".$row['id1']."/index.htm\">".$tmp['name']."</a>";?></td>
  <td>--</td>
  <td><a href="/sjshturniere/ljem/<?php echo JAHR; ?>/<?php 
		$tmp = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT name FROM ".db_spieler." WHERE id = '".$row['id2']."'"));
		echo $temp['queryakarray'][$ak-1][0]."/".$row['id2']."/index.htm\">".$tmp['name']."</a>";?></td>
  <td align="center"><?php 
  	if($row['flag']==1) echo ekampflos($row['erg1']).":".ekampflos($row['erg2']);
  	elseif($row['erg1']>0 OR $row['erg2']>0) echo eergebnis($row['erg1']).":".eergebnis($row['erg2']);?></td>
</tr>
<?php
	}
?>
</table>
</div>
<?php
}
?>
