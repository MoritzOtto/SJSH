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
require_once('class.value.php');
require_once('class.entity.php');
require_once('class.getEntityService.php');


/**
 * Plugin 'Event_EAV' for the 'sjsh_eventmanager_eav' extension.
 *
 * @author	Moritz Otto <moritz.otto@sjsh.de>
 * @package	TYPO3
 * @subpackage	tx_sjsheventmanagereav
 */
class tx_sjsheventmanagereav_pi1 extends tslib_pibase {
	var $prefixId      = 'tx_sjsheventmanagereav_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_sjsheventmanagereav_pi1.php';	// Path to this script relative to the extension dir.
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
		
		if($this->conf['columns'])
		{
		   $columns = $this->conf['columns'];	
		}
		else
		{
		   $columns = 3;
		}
		
	  $db = new Database();
	  $entityService = new GetEntityService($db);
	  
	  $entityObject = $entityService->GetEntities($id);
	  $fields = $entityService->GetFields($id);
	  $eventName = $entityService->GetEventName($id);
	      
    // Read the template
    $this->templateHtml = $this->cObj->fileResource('typo3conf/ext/sjsh_eventmanager_eav/pi1/template.html');
 
  // Extract subparts from the template
  $subparts['template'] = $this->cObj->getSubpart($this->templateHtml, '###TEMPLATE###');
  $subparts['eventinfo'] = $this->cObj->getSubpart($subparts['template'], '###EVENTINFO###');
  $subparts['fields'] = $this->cObj->getSubpart($subparts['template'], '###FIELDS###');
  $subparts['entities'] = $this->cObj->getSubpart($subparts['template'], '###ENTITIES###');
  $subparts['entityFields'] = $this->cObj->getSubpart($subparts['entities'], '###ENTITYFIELDS###');

  $marker['###EVENT###'] = $eventName;
  $contentItem .= $this->cObj->substituteMarkerArray($subparts['eventinfo'], $marker);
  $subpartArray['###EVENTINFOCONTENT###'] = $contentItem;

  $contentItem = "";
  $i = 0;
/*  foreach($fields as $field)
  {
	  if($i < 3) {
  	// Fill marker array 
   	$fieldArray['###FIELDNAME###'] = $field->name;          
     
     // Substitute markers and append to result string
     $contentItem .= $this->cObj->substituteMarkerArrayCached($subparts['fields'], $fieldArray);
	 			$i++;
		  }
  }*/
  $subpartArray['###FIELDSCONTENT###'] = $contentItem;
  


  $contentItem = "";
  foreach($entityObject as $entry)
  {
      $cont= "";
	  $i = 0;
      foreach($entry->GetValues() as $e)
      {
		  if($i < $columns) {
			$valueArray['###VALUE###'] = $e->GetValue();
			$cont .= $this->cObj->substituteMarkerArray($subparts['entityFields'], $valueArray);
			$i++;
		  }
      }
     
      $fieldArray['###ENTITYFIELDSCONTENT###'] = $cont; 
  
      $contentItem .= $this->cObj->substituteMarkerArrayCached($subparts['entities'], array(), $fieldArray);
  }
  
  $subpartArray['###ENTITIESCONTENT###'] = $contentItem; 
  
  $content .= $this->cObj->substituteMarkerArrayCached($subparts['template'], array(), $subpartArray);
		return $this->pi_wrapInBaseClass($content);
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sjsh_eventmanager_eav/pi1/class.tx_sjsheventmanagereav_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sjsh_eventmanager_eav/pi1/class.tx_sjsheventmanagereav_pi1.php']);
}

?>