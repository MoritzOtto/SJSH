<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2013 Moritz Otto <moritz.otto@sjsh.de>
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
require_once('class.database.php');
require_once('class.getEntityService.php');
require_once('class.value.php');


/**
 * Plugin 'Registration form EAV' for the 'sjsh_eventmanager_eav' extension.
 *
 * @author	Moritz Otto <moritz.otto@sjsh.de>
 * @package	TYPO3
 * @subpackage	tx_sjsheventmanagereav
 */
class tx_sjsheventmanagereav_pi2 extends tslib_pibase {
	var $prefixId      = 'tx_sjsheventmanagereav_pi2';		// Same as class name
	var $scriptRelPath = 'pi2/class.tx_sjsheventmanagereav_pi2.php';	// Path to this script relative to the extension dir.
	var $extKey        = 'sjsh_eventmanager_eav';	// The extension key.
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
		
		if($this->conf['eventId'])
		{
		   $id = $this->conf['eventId'];	
		}
		else
		{
		   throw new Exception("There is no event id!");	
		}                
		
    $var = t3lib_div::_POST('saved');
    
    $db = new DatabasePi2();
	  $entityService = new GetEntityServicePi2($db);
	  
	  $fields = $entityService->GetFields($id);
	  $event = $entityService->GetEventName($id);
    
    $content = "<h2>".$event."</h2>";
    if(isset($var))
    {
        $values = array();
        foreach($fields as $field)
        {
          $name = str_replace(' ','',$field["name"]);
          $fieldValue = t3lib_div::_POST('Field'.$name);
          $newValue = new ValuePi2();
          $newValue->SetField($field["name"]);
          $newValue->SetValue($fieldValue);
          $values[] = $newValue;
        }
        $db->SaveEntity($values, $id);
        
        $content .= "Gespeichert!";
    }
    else
    {
      $content .= "<table><form method='post'>";
      
      foreach($fields as $field)
      {
        $name = str_replace(' ','',$field["name"]);
        $content .= "<tr><td style='min-width:130px;'>".$field["name"]."</td><td><input name='Field".$name."' type='text'/></td></tr>";
      }
      
      $content .= "<tr><td><input type='submit' name='saved' value='Registrieren'/></td></tr></form></table>";  
    }
	
		return $this->pi_wrapInBaseClass($content);
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sjsh_eventmanager_eav/pi2/class.tx_sjsheventmanagereav_pi2.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sjsh_eventmanager_eav/pi2/class.tx_sjsheventmanagereav_pi2.php']);
}

?>