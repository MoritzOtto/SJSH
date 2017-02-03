<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_extMgm::addToInsertRecords('tx_sjshljemadmin_aks');

$TCA['tx_sjshljemadmin_aks'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_aks',		
		'label'     => 'u',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_sjshljemadmin_aks.gif',
	),
);

$TCA['tx_sjshljemadmin_ergebnisse'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_ergebnisse',		
		'label'     => 'klasse',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_sjshljemadmin_ergebnisse.gif',
	),
);


t3lib_extMgm::addToInsertRecords('tx_sjshljemadmin_spieler');

$TCA['tx_sjshljemadmin_spieler'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_spieler',		
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
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_sjshljemadmin_spieler.gif',
	),
);


t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key,pages';


t3lib_extMgm::addPlugin(array(
	'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tt_content.list_type_pi1',
	$_EXTKEY . '_pi1',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');


t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi2']='layout,select_key,pages';


t3lib_extMgm::addPlugin(array(
	'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tt_content.list_type_pi2',
	$_EXTKEY . '_pi2',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');


t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi3']='layout,select_key,pages';


t3lib_extMgm::addPlugin(array(
	'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tt_content.list_type_pi3',
	$_EXTKEY . '_pi3',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');


t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi4']='layout,select_key,pages';


t3lib_extMgm::addPlugin(array(
	'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tt_content.list_type_pi4',
	$_EXTKEY . '_pi4',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');


t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi5']='layout,select_key,pages';


t3lib_extMgm::addPlugin(array(
	'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tt_content.list_type_pi5',
	$_EXTKEY . '_pi5',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');


if (TYPO3_MODE == 'BE') {
	t3lib_extMgm::addModulePath('web_txsjshljemadminM1', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
		
	t3lib_extMgm::addModule('web', 'txsjshljemadminM1', '', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
}


if (TYPO3_MODE == 'BE') {
	t3lib_extMgm::addModulePath('web_txsjshljemadminM2', t3lib_extMgm::extPath($_EXTKEY) . 'mod2/');
		
	t3lib_extMgm::addModule('web', 'txsjshljemadminM2', '', t3lib_extMgm::extPath($_EXTKEY) . 'mod2/');
}
?>