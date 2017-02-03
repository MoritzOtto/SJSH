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
 * Plugin 'ergebnisse' for the 'sjsh_ljemadmin' extension.
 *
 * @author	Moritz Otto <moritz.otto@sjsh.de>
 * @package	TYPO3
 * @subpackage	tx_sjshljemadmin
 */
class tx_sjshljemadmin_pi1 extends tslib_pibase {
	var $prefixId      = 'tx_sjshljemadmin_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_sjshljemadmin_pi1.php';	// Path to this script relative to the extension dir.
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
		
		$id = $_GET['id'];
    $runde = $_GET['runde'];
    $ak = $_GET['ak'];
    
    if(!isset($runde)){
          $content .= "<h2>Bitte Runde ausw&auml;hlen</h2><ol>";	
          $sql = "SELECT DISTINCT runde FROM ".db_ergebnisse." WHERE klasse='".$ak."' ORDER BY runde ASC";
          $result=$GLOBALS['TYPO3_DB']->sql_query("SELECT DISTINCT runde FROM ".db_ergebnisse." WHERE klasse='".$ak."' ORDER BY runde ASC");
          
          	while($row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)){
          	
                  $content .= "<li><a href='index.php?id=".$id."&ak=".$ak."&runde=".$row['runde']."'> Runde ".$row['runde']."</a></li>";
            	}
          
          $content .= "</ol>";   
    }
    else
    {
      $prev = $runde - 1;
      $nxt = $runde + 1;
      $gak = gak($ak);
      $content .= "<h2>Altersklasse ".$gak." - Runde ".$runde."</h2> ";
      if($prev > 0)
        $content .= "<div style='float:left'><a href='index.php?id=".$id."&runde=".$prev."&ak=".$ak."'>&lt;-".$prev.". Runde</a></div>";
      if(($nxt < 10 && $ak <11) || ($nxt < 12 && $ak >10))
        $content .= "<div style='float:right'><a href='index.php?id=".$id."&runde=".$nxt."&ak=".$ak."'>".$nxt.". Runde -&gt;</a></div>";
      $content .= "<div align='center' style='clear:both;'><table class='col' width='95%'>";
      $content .= "<tr><th>Tisch</th>	<th>Teilnehmer</th><th>--</th>	<th>Teilnehmer</th>";
      $content .= "<th><div align='center'>Ergebnis</div></th>  </tr>";
	    $result=$GLOBALS['TYPO3_DB']->sql_query("SELECT * FROM ".db_ergebnisse." WHERE klasse='".$ak."' AND runde='".$runde."' order by tisch");
	
      while($row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)){

        $tmp = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT name FROM ".db_spieler." WHERE uid = '".$row['id1']."'"));
        $content .= "<tr><td align='center'>".$row['tisch']."</td><td><a href=";
		    $content .= "'index.php?id=".$conf['pID']."&teilnehmerID=".$row['id1']."'>".$tmp['name']."</a></td>";
        
        $tmp = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($GLOBALS['TYPO3_DB']->sql_query("SELECT name FROM ".db_spieler." WHERE uid = '".$row['id2']."'"));
        $content .= "<td>--</td>  <td><a href=";
		    $content .= "'index.php?id=".$conf['pID']."&teilnehmerID=".$row['id2']."'>".$tmp['name']."</a></td>";
        $content .= "<td align='center'>";
        
  	   if($row['flag']==1) 
        {
          $content .= ekampflos($row['erg1']).":".ekampflos($row['erg2']);
        }
  	   elseif($row['erg1']>0 OR $row['erg2']>0) 
        {
          $content .= eergebnis($row['erg1']).":".eergebnis($row['erg2'])."</td>";
        }
       $content .= "</tr>";

	   }

    $content .= "</table></div>";  
    }

	
		return $this->pi_wrapInBaseClass($content);
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sjsh_ljemadmin/pi1/class.tx_sjshljemadmin_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sjsh_ljemadmin/pi1/class.tx_sjshljemadmin_pi1.php']);
}

?>