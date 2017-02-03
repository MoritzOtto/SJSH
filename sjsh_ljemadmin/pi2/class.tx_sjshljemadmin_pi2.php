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

require_once(PATH_tslib.'class.tslib_pibase.php');
require_once('func_general.inc.php');


/**
 * Plugin 'rangliste' for the 'sjsh_ljemadmin' extension.
 *
 * @author	Moritz Otto <moritz.otto@sjsh.de>
 * @package	TYPO3
 * @subpackage	tx_sjshljemadmin
 */
class tx_sjshljemadmin_pi2 extends tslib_pibase {
	var $prefixId      = 'tx_sjshljemadmin_pi2';		// Same as class name
	var $scriptRelPath = 'pi2/class.tx_sjshljemadmin_pi2.php';	// Path to this script relative to the extension dir.
	var $extKey        = 'sjsh_ljemadmin';	// The extension key.
	var $pi_checkCHash = true;
	
	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	function main($content, $conf) {
		$this->conf = $conf;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();
		
	  $runde = $_GET['runde'];
    $ak = $_GET['ak'];
    
    $gak = gak($ak);
    
    $content .= "<h1>Altersklasse ".$gak."</h1>    <h2>Rangliste nach der "; 
    $row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT runde FROM ".db_ergebnisse." WHERE klasse='$ak' AND (erg1>0 OR erg2>0) AND flag=0 ORDER BY runde DESC LIMIT 0,1"));
    
    $content .= $row['runde'].". Runde</h2>";
    
    $row2=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT modus FROM ".db_aks." WHERE uid = '$ak' LIMIT 0,1"));
    $result=$GLOBALS['TYPO3_DB']->sql_query("SELECT * FROM ".db_spieler." WHERE uid > '".($ak*100)."' AND uid < '".($ak*100+100)."' ORDER BY rang ASC");
    
    $content .= "<div align='center'>
    <table class='wb' cellpadding='2'>
      <tr>
        <th>Rang</th>
    	<th>Name</th>
    	<th>ELO</th>
    	<th>DWZ</th>
    	<th>Verein</th>
    	<th>G</th>
    	<th>S</th>
    	<th>R</th>
    	<th>V</th>
    	<th>Punkte</th>";
    	
    	 if ($row2['modus'] == 'ch') { $content .= "<th>Buch</th>"; } 
    	 if ($row2['modus'] == 'r') { $content .= "<th>SoBerg</th>"; } 
    	$content .= "
    	<th>Attr.</th>
      </tr>";
    
    while($row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)){
      $content .= "<tr>
        <td>".$row['rang'].".</td>
    	<td><a href='index.php?id=".$conf['pID']."&teilnehmerID=".$row['uid']."'>".$row['name']."</a></td>";
    	
      $content .= "<td align='center'>".($row['elo'] ? $row['elo'] : '----')."</td>";
    	$content .= "<td align='center'>".($row['dwz'] ? $row['dwz'] : '----')."</td>";
    	$content .= "<td>".$row['verein']."</td>";
    	$content .= "<td align='center'>".($row['s']+$row['r']+$row['v'])."</td>";
    	$content .= "<td align='center'>".$row['s']."</td>";
    	$content .= "<td align='center'>".$row['r']."</td>";
    	$content .= "<td align='center'>".$row['v']."</td>";
    	$content .= "<td align='center'>".$row['punkte']."</td>";
    	 if ($row2['modus'] == 'ch') { $content .= "<td align='center'>".$row['buch']."</td>"; } 
    	 if ($row2['modus'] == 'r') { $content .= "<td align='center'>".$row['soberg']."</td>"; } 

    	$content .= "<td align='center'>".$row['attr']."</td></tr>";

    	}
    
    $content .= "</table>
    </div>";    
	
		return $this->pi_wrapInBaseClass($content);
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sjsh_ljemadmin/pi2/class.tx_sjshljemadmin_pi2.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sjsh_ljemadmin/pi2/class.tx_sjshljemadmin_pi2.php']);
}

?>