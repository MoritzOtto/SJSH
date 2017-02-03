<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Moritz Otto <moritz.otto@sjsh.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */


$LANG->includeLLFile('EXT:sjsh_ljemadmin/mod2/locallang.xml');
require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('backend') . 'Classes/Module/BaseScriptClass.php');
require_once('func_general.inc.php');
$BE_USER->modAccess($MCONF,1);	// This checks permissions and exits if the users has no permission for entry.
	// DEFAULT initialization of a module [END]



/**
 * Module 'teilnehmerliste' for the 'sjsh_ljemadmin' extension.
 *
 * @author	Moritz Otto <moritz.otto@sjsh.de>
 * @package	TYPO3
 * @subpackage	tx_sjshljemadmin
 */
class  tx_sjshljemadmin_module2 extends t3lib_SCbase {
				var $pageinfo;

				/**
				 * Initializes the Module
				 * @return	void
				 */
				function init()	{
					global $BE_USER,$LANG,$BACK_PATH,$TCA_DESCR,$TCA,$CLIENT,$TYPO3_CONF_VARS;

					parent::init();

					/*
					if (t3lib_div::_GP('clear_all_cache'))	{
						$this->include_once[] = PATH_t3lib.'class.t3lib_tcemain.php';
					}
					*/
				}

				/**
				 * Adds items to the ->MOD_MENU array. Used for the function menu selector.
				 *
				 * @return	void
				 */
				function menuConfig()	{
					global $LANG;
					$this->MOD_MENU = Array (
						'function' => Array (
							'1' => $LANG->getLL('function1'),
							'2' => $LANG->getLL('function2'),
							'3' => $LANG->getLL('function3'),
						)
					);
					parent::menuConfig();
				}

				/**
				 * Main function of the module. Write the content to $this->content
				 * If you chose "web" as main module, you will need to consider the $this->id parameter which will contain the uid-number of the page clicked in the page tree
				 *
				 * @return	[type]		...
				 */
				function main()	{
					global $BE_USER,$LANG,$BACK_PATH,$TCA_DESCR,$TCA,$CLIENT,$TYPO3_CONF_VARS;

					// Access check!
					// The page will show only if there is a valid page and if this page may be viewed by the user
					$this->pageinfo = t3lib_BEfunc::readPageAccess($this->id,$this->perms_clause);
					$access = is_array($this->pageinfo) ? 1 : 0;
				
					if (($this->id && $access) || ($BE_USER->user['admin'] && !$this->uid))	{

							// Draw the header.
						$this->doc = t3lib_div::makeInstance('mediumDoc');
						$this->doc->backPath = $BACK_PATH;


						$headerSection = $this->doc->getHeader( "pages", $this->pageinfo, $this->pageinfo["_thePath"] ).'<br />' . $LANG->php3Lang['labels']['path'] . ': ' . t3lib_div::fixed_lgd_cs($this->pageinfo["_thePath"], 50);

						$this->content.=$this->doc->startPage($LANG->getLL('title'));
						$this->content.=$this->doc->header($LANG->getLL('title'));
						$this->content.=$this->doc->spacer(5);
						$this->content.=$this->doc->section('',$this->doc->funcMenu($headerSection,t3lib_BEfunc::getFuncMenu($this->uid,'SET[function]',$this->MOD_SETTINGS['function'],$this->MOD_MENU['function'])));
						$this->content.=$this->doc->divider(5);


$input =  $_POST['input'];



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
	$query="SELECT uid FROM ".db_aks." WHERE uid<90 and jahr = ".$year." ORDER BY sort ASC";
	$result=$GLOBALS['TYPO3_DB']->sql_query($query);
	while($row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)){
		?>
    <option value="<?php echo $row['uid'];?>"<?php if($input['klasse']==$row['uid']) echo " selected=\"selected\""?>> 
		<?php echo gak($row['uid']);?></option>
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
		$row1 = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT name FROM ".db_spieler." WHERE uid = '".($input['klasse']*100+$temp2[2])."' LIMIT 0,1"));
		$row2 = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT name FROM ".db_spieler." WHERE uid = '".($input['klasse']*100+$temp2[3])."' LIMIT 0,1"));
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









						// ShortCut
						if ($BE_USER->mayMakeShortcut())	{
							$this->content.=$this->doc->spacer(20).$this->doc->section('',$this->doc->makeShortcutIcon('id',implode(',',array_keys($this->MOD_MENU)),$this->MCONF['name']));
						}

						$this->content.=$this->doc->spacer(10);
					} else {
							// If no access or if ID == zero

						$this->doc = t3lib_div::makeInstance('mediumDoc');
						$this->doc->backPath = $BACK_PATH;

						$this->content.=$this->doc->startPage($LANG->getLL('title'));
						$this->content.=$this->doc->header($LANG->getLL('title'));
						$this->content.=$this->doc->spacer(5);
						$this->content.=$this->doc->spacer(10);
					}
				
				}

				/**
				 * Prints out the module HTML
				 *
				 * @return	void
				 */
				function printContent()	{

					$this->content.=$this->doc->endPage();
					echo $this->content;
				}

				/**
				 * Generates the module content
				 *
				 * @return	void
				 */
				function moduleContent()	{
					switch((string)$this->MOD_SETTINGS['function'])	{
						case 1:
							$content='<div align="center"><strong>Hello World!</strong></div><br />
								The "Kickstarter" has made this module automatically, it contains a default framework for a backend module but apart from that it does nothing useful until you open the script '.substr(t3lib_extMgm::extPath('sjsh_ljemadmin'),strlen(PATH_site)).'mod2/index.php and edit it!
								<hr />
								<br />This is the GET/POST vars sent to the script:<br />'.
								'GET:'.t3lib_div::view_array($_GET).'<br />'.
								'POST:'.t3lib_div::view_array($_POST).'<br />'.
								'';
							$this->content.=$this->doc->section('Message #1:',$content,0,1);
						break;
						case 2:
							$content='<div align=center><strong>Menu item #2...</strong></div>';
							$this->content.=$this->doc->section('Message #2:',$content,0,1);
						break;
						case 3:
							$content='<div align=center><strong>Menu item #3...</strong></div>';
							$this->content.=$this->doc->section('Message #3:',$content,0,1);
						break;
					}
				}
				
		}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sjsh_ljemadmin/mod2/index.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sjsh_ljemadmin/mod2/index.php']);
}




// Make instance:
$SOBE = t3lib_div::makeInstance('tx_sjshljemadmin_module2');
$SOBE->init();

// Include files?
foreach($SOBE->include_once as $INC_FILE)	include_once($INC_FILE);

$SOBE->main();
$SOBE->printContent();

?>