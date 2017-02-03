<?php
require_once(PATH_tslib.'class.tslib_pibase.php');
require_once ('database.php');

class tx_sjshdates_pi2 extends tslib_pibase {	

var $prefixId      = 'tx_sjshdates_pi2';		
var $scriptRelPath = 'pi2/class.tx_sjshdates_pi2.php';	
	var $extKey        = 'sjsh_dates';	
  var $pi_checkCHash = true;	
  	function main($content, $conf) {		
    $this->conf = $conf;		$this->pi_setPiVarDefaults();		$this->pi_loadLL();					
    $db = new databaseDatesAll();		
    $do = $db->getnextsh(); 
    $i = 0;		
    $cont = '';	
    while($i < 5 && $row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($do))		
    {	
      $i ++;		
      $dateb = date("d.m.Y", $row["begin"]);			
  	   $link = $this->cObj->typolink($row["name"],array('parameter'=>$row["url"]));
  	   $cont = $cont."<tr><td style='width:160px;'>".$link."</td><td>$dateb</td></tr>";				
    }	    
    
    
    $template = $this->cObj->fileResource('EXT:sjsh_dates/pi2/template.html');    	  $subpart = $this->cObj->getSubpart($template, '###TEMPLATE###');	  $markerArray['###CONTENT###'] = $cont;		$content=$this->cObj->substituteMarkerArrayCached($subpart, $markerArray);			return $this->pi_wrapInBaseClass($content);	}}if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sjsh_dates/pi2/class.tx_sjshdates_pi2.php'])	{	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sjsh_dates/pi2/class.tx_sjshdates_pi2.php']);}?>