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
 * Plugin 'telnehmer' for the 'sjsh_ljemadmin' extension.
 *
 * @author	Moritz Otto <moritz.otto@sjsh.de>
 * @package	TYPO3
 * @subpackage	tx_sjshljemadmin
 */
class tx_sjshljemadmin_pi4 extends tslib_pibase {
	var $prefixId      = 'tx_sjshljemadmin_pi4';		// Same as class name
	var $scriptRelPath = 'pi4/class.tx_sjshljemadmin_pi4.php';	// Path to this script relative to the extension dir.
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
		
		
		
      $teilnehmer_id = $_GET['teilnehmerID'];
      
      $row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT * FROM ".db_spieler." WHERE uid='".$teilnehmer_id."' LIMIT 0,1"));
      $ak = floor($teilnehmer_id/100);
      
      $content .= "<h2>Teilnehmer: ".$row['name']."</h2>";
      
      $content .= "<div class='zweispaltig'>
        <table class='col'>
          <tr> 
            <th>Name</th>
            <td>".$row['name']."</td>
          </tr>
          <tr> 
            <th>Verein</th>
            <td>".$row['verein']."</td>
          </tr>

      	<tr> 
            <th>ELO</th>
            <td>".($row['elo'] ? $row['elo'] : "----")."</td>
          </tr>
          <tr> 
            <th>DWZ</th>
            <td>".($row['dwz'] ? $row['dwz'] : "----")."</td>
          </tr>
          <tr> 
            <th>&nbsp;</th>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <th>Spielklasse</th>
            <td>".gak($ak)."</td>
          </tr>
          <tr> 
            <th>Rang</th>
            <td>
              ".$row['rang'].". Platz nach der ".grunde($ak).". Runde</td>
          </tr>
        </table>
        </div>
      
      <div class='zweispaltig'>"; 
        
        $search = array("ä", "ö", "ü", "ß", " ");
        $replace = array("ae", "oe", "ue", "ss", "");
        $name = explode(",", str_replace($search, $replace, strtolower($row['name'])));
        $name[1] = explode("-", $name[1]);
        $name[1] = explode(" ", $name[1][0]);
        $name[1] = $name[1][0];
      
        $content .= "</div>
      </div>	
      <br clear='all'>
      <h3>Ergebnisse</h3>	
      <div align='center'>
      <table class='wb'>
        <tr>
          <th>Runde</th>
      	<th>Tisch</th>
      	<th>Teilnehmer</th>
      	<th>--</th>
      	<th>Teilnehmer</th>
      	<th>Ergebnis</th>
        </tr>";
      
      	$result=$GLOBALS['TYPO3_DB']->sql_query("SELECT * FROM ".db_ergebnisse." WHERE (id1=".$teilnehmer_id." OR id2=".$teilnehmer_id.") AND klasse='".$ak."' ORDER BY runde ASC");
      	while($ro=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)){
      		
        $content .= "<tr>
          <td align='center'>".$ro['runde']."</td>
          <td align='center'>".$ro['tisch']."</td>
          <td>";
          
          if ($ro['id1'] == $teilnehmer_id) {
      		$content .= $row['name'];
      	} else {
      		$tmp = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT name FROM ".db_spieler." WHERE uid = '".$ro['id1']."'"));
      		$content .=  "<a href='index.php?id=".$conf['pID']."&teilnehmerID=".$ro['id1']."'>".$tmp['name']."</a>";
      	} 
        
        
          $content .= "</td>
          <td>--</td>
          <td>";
          
          if ($ro['id2'] == $teilnehmer_id) {
      		$content .= $row['name'];
      	} else {
      		$tmp = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT name FROM ".db_spieler." WHERE uid = '".$ro['id2']."'"));
      			$content .=  "<a href='index.php?id=".$conf['pID']."&teilnehmerID=".$ro['id2']."'>".$tmp['name']."</a>";
      	} 
        
        
        $content .= "</td>
          <td align='center'>";
           
      	if($ro['flag']==1) $content .=  ekampflos($ro['erg1']).":".ekampflos($ro['erg2']);
      		elseif($ro['erg1']>0 OR $ro['erg2']>0) $content .=  eergebnis($ro['erg1']).":".eergebnis($ro['erg2']);
      	$content .= "</td>
        </tr>";	
        
        	}
      	
      $content .= "</table>
      </div>";	
	
		return $this->pi_wrapInBaseClass($content);
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sjsh_ljemadmin/pi4/class.tx_sjshljemadmin_pi4.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sjsh_ljemadmin/pi4/class.tx_sjshljemadmin_pi4.php']);
}

?>