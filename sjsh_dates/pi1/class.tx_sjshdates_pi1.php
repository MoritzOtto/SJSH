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
require_once ('database.php');

/**
 * Plugin 'AllDates' for the 'sjsh_dates' extension.
 *
 * @author	Moritz Otto <moritz.otto@sjsh.de>
 * @package	TYPO3
 * @subpackage	tx_sjshdates
 */
class tx_sjshdates_pi1 extends tslib_pibase {
	var $prefixId      = 'tx_sjshdates_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_sjshdates_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey        = 'sjsh_dates';	// The extension key.
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
		
		$db = new databaseDates();
		$do = $db->selectdates();
		$cont = '';
			$GLOBALS['TYPO3_DB']->sql_num_rows($do);
		while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($do))
		{
			$dateb = date("d.m.Y", $row["begin"]);
			$datee = date("d.m.Y", $row["end"]);
			
			$link = $this->cObj->typolink($row["name"],array('parameter'=>$row["url"]));
			$cont = $cont."<tr><td>".$link."</td><td>".$row["ausrichter"]."</td><td>$dateb</td><td>$datee</td><td>".$row["location"]."</td></tr>";
		
		}	
    $template = $this->cObj->fileResource('EXT:sjsh_dates/pi1/template.html');
    
	  $subpart = $this->cObj->getSubpart($template, '###TEMPLATE###');
	  $markerArray['###CONTENT###'] = $cont;


		$content=$this->cObj->substituteMarkerArrayCached($subpart, $markerArray);

	
		return $this->pi_wrapInBaseClass($content);
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sjsh_dates/pi1/class.tx_sjshdates_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sjsh_dates/pi1/class.tx_sjshdates_pi1.php']);
}

?>