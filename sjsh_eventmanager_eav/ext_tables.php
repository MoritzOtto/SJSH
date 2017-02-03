<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
$TCA['tx_sjsheventmanagereav_event'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:sjsh_eventmanager_eav/locallang_db.xml:tx_sjsheventmanagereav_event',		
		'label'     => 'name',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_sjsheventmanagereav_event.gif',
	),
);

$TCA['tx_sjsheventmanagereav_field'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:sjsh_eventmanager_eav/locallang_db.xml:tx_sjsheventmanagereav_field',		
		'label'     => 'name',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_sjsheventmanagereav_field.gif',
	),
);

$TCA['tx_sjsheventmanagereav_event_to_field'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:sjsh_eventmanager_eav/locallang_db.xml:tx_sjsheventmanagereav_event_to_field',		
		'label'     => 'uid',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_sjsheventmanagereav_event_to_field.gif',
	),
);

$TCA['tx_sjsheventmanagereav_Value'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:sjsh_eventmanager_eav/locallang_db.xml:tx_sjsheventmanagereav_Value',		
		'label'     => 'entity',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_sjsheventmanagereav_Value.gif',
	),
);

$TCA['tx_sjsheventmanagereav_entity'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:sjsh_eventmanager_eav/locallang_db.xml:tx_sjsheventmanagereav_entity',		
		'label'     => 'uid',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'type' => 'name',	
		'default_sortby' => 'ORDER BY crdate',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_sjsheventmanagereav_entity.gif',
	),
);


t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key,pages';


t3lib_extMgm::addPlugin(array(
	'LLL:EXT:sjsh_eventmanager_eav/locallang_db.xml:tt_content.list_type_pi1',
	$_EXTKEY . '_pi1',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');


if (TYPO3_MODE == 'BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_sjsheventmanagereav_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_sjsheventmanagereav_pi1_wizicon.php';
}


t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi2']='layout,select_key,pages';


t3lib_extMgm::addPlugin(array(
	'LLL:EXT:sjsh_eventmanager_eav/locallang_db.xml:tt_content.list_type_pi2',
	$_EXTKEY . '_pi2',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');


if (TYPO3_MODE == 'BE') {
	t3lib_extMgm::addModulePath('web_txsjsheventmanagereavM1', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
		
	t3lib_extMgm::addModule('web', 'txsjsheventmanagereavM1', '', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
}
?>