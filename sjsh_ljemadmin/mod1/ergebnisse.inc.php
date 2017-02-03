<?
if ($input['submit'] == "speichern" && $input['klasse']) {
	$temp=explode("\n",stripslashes($input['idtext']));
	for($x=0;$x<count($temp) && strlen($temp[$x]) > 10;$x++){
		$temp2=explode(";",str_replace("\"", "", $temp[$x]));
		if ($GLOBALS['TYPO3_DB']->sql_fetch_row($GLOBALS['TYPO3_DB']->sql_query("SELECT tisch FROM ".db_ergebnisse." WHERE klasse = '".$input['klasse']."' AND runde = '".$input['runde']."' AND tisch = '".$temp2[1]."' LIMIT 0,1"))) {
			$sql = "UPDATE ".db_ergebnisse." SET id1 = '".($input['klasse']*100+$temp2[2])."', id2 = '".($input['klasse']*100+$temp2[3])."', erg1 = '".(strpos($temp2[6], "r") === false ? $temp2[6] : 0.5)."', erg2 = '".(strpos($temp2[7], "r") === false ? $temp2[7] : 0.5)."', flag = '".(strpos($temp2[8], "k") === false ? 0 : 1)."' WHERE klasse = '".$input['klasse']."' AND runde = '".$input['runde']."' AND tisch = '".$temp2[1]."' LIMIT 1";
		} else {
			$sql = "INSERT INTO ".db_ergebnisse." (klasse, runde, tisch, id1, id2, erg1, erg2, flag) VALUES ('".$input['klasse']."', '".$input['runde']."', '".$temp2[1]."', '".($input['klasse']*100+$temp2[2])."', '".($input['klasse']*100+$temp2[3])."', '".(strpos($temp2[6], "r") === false ? $temp2[6] : 0.5)."', '".(strpos($temp2[7], "r") === false ? $temp2[7] : 0.5)."', '".(strpos($temp2[8], "k") === false ? 0 : 1)."')";
		}
		$GLOBALS['TYPO3_DB']->sql_query($sql);
		
		
		$GLOBALS['TYPO3_DB']->sql_query("delete FROM ".db_ergebnisse." WHERE tisch = 0");
		echo $sql."<br>\n";
	}
	echo "updating ...";
	updateTabelle($input['klasse']);
} else {
?>
<h1>Ergebnisse einlesen</h1>
<form name="liste" action="<? echo $_SERVER['REQUEST_URI'] ?>" method="post">
  <h3>Altersklasse, Runde</h3>
<p>
  <select name="input[klasse]">
    <option value=""<?php if($input['klasse']=="") echo " selected=\"selected\""?>>Bitte w&auml;hlen...</option>
    <?php
    $year = date("Y");

	$query="SELECT id, attribut FROM ".db_aks." WHERE id<90 AND jahr = ".$year." ORDER BY sort ASC";
	$result=$GLOBALS['TYPO3_DB']->sql_query($query);
	while($row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)){
		?>
    <option value="<?php echo $row['id'];?>"<?php if($input['klasse']==$row['id']) echo " selected=\"selected\""?>> 
		<?php echo gak($row['id']);?></option>
	<?php } ?>
  </select>
  <select name="input[runde]"><option value="">Bitte w&auml;hlen...</option>
  <?php 
  	for($x=1;$x<=11;$x++){ ?>
    <option value="<?php echo $x;?>"<?php if($input['runde']==$x) echo " selected=\"selected\"";?>>Runde <?php 
	echo $x;?></option>
  <?php
  	}
  ?>
  </select>
  </p>
<h3>Export aus SwissChess einf&uuml;gen</h3>
<p>
  <textarea name="input[idtext]" cols="80" rows="5"><?php echo stripslashes($input['idtext']);?></textarea>
</p>
<p><input type="submit" name="input[submit]" value="zuordnen"></p>

<?
if ($input['submit'] == "zuordnen" && $input['klasse']) {
		//ID-Text nach Zeilenumbruch trennen
		$temp=explode("\n",stripslashes($input['idtext']));
		//Zeilen auslesen
		echo "<table><tr><td>tisch</td><td>ak</td><td>weiss</td><td>schwarz</td><td>erg</td><td>flag</td></tr>";
	for($x=0;$x<count($temp) && strlen($temp[$x]) > 10;$x++){
		$temp2=explode(";",str_replace("\"", "", $temp[$x]));
		$row1 = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT name FROM ".db_spieler." WHERE id = '".($input['klasse']*100+$temp2[2])."' LIMIT 0,1"));
		$row2 = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT name FROM ".db_spieler." WHERE id = '".($input['klasse']*100+$temp2[3])."' LIMIT 0,1"));
			echo "<tr>
				<td>".$temp2[1]."</td>
				<td>".gak($input['klasse'])."</td>
				<td>".$temp2[4]."<br>".$row1['name']."</td>
				<td>".$temp2[5]."<br>".$row2['name']."</td>
				<td>".(strpos($temp2[6], "r") === false ? $temp2[6] : 0.5)." - ".(strpos($temp2[7], "r") === false ? $temp2[7] : 0.5)."</td>
				<td>".(strpos($temp2[8], "k") === false ? 0 : 1)."</td>
				</tr>";
			}
		echo "</table>";
?>
<p><input type="submit" name="input[submit]" value="speichern"></p>
<?
}
?>
</form>
<?
}
?>



