<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_extMgm::addToInsertRecords('tx_sjshgrandprix_gp_AK');

$TCA['tx_sjshgrandprix_gp_AK'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_AK',		
		'label'     => 'ak_name',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_sjshgrandprix_gp_AK.gif',
	),
);


t3lib_extMgm::addToInsertRecords('tx_sjshgrandprix_gp_Punkte');

$TCA['tx_sjshgrandprix_gp_Punkte'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_Punkte',		
		'label'     => 'spieler_id',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_sjshgrandprix_gp_Punkte.gif',
	),
);


t3lib_extMgm::addToInsertRecords('tx_sjshgrandprix_gp_Spieler');

$TCA['tx_sjshgrandprix_gp_Spieler'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_Spieler',		
		'label'     => 'spieler_name',	
		'label_alt' => 'spieler_vorname',
		'label_alt_force' => 1,
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_sjshgrandprix_gp_Spieler.gif',
	),
);


t3lib_extMgm::addToInsertRecords('tx_sjshgrandprix_gp_Turnier');

$TCA['tx_sjshgrandprix_gp_Turnier'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_Turnier',		
		'label'     => 'turnier_veranstalter',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_sjshgrandprix_gp_Turnier.gif',
	),
);


t3lib_extMgm::addToInsertRecords('tx_sjshgrandprix_gp_Verein');

$TCA['tx_sjshgrandprix_gp_Verein'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_Verein',		
		'label'     => 'verein_name',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_sjshgrandprix_gp_Verein.gif',
	),
);


t3lib_extMgm::addToInsertRecords('tx_sjshgrandprix_gp_AgeClassToPlayer');

$TCA['tx_sjshgrandprix_gp_AgeClassToPlayer'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_AgeClassToPlayer',		
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
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_sjshgrandprix_gp_AgeClassToPlayer.gif',
	),
);


t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key,pages';


t3lib_extMgm::addPlugin(array(
	'LLL:EXT:sjsh_grandprix/locallang_db.xml:tt_content.list_type_pi1',
	$_EXTKEY . '_pi1',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');


t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi2']='layout,select_key,pages';


t3lib_extMgm::addPlugin(array(
	'LLL:EXT:sjsh_grandprix/locallang_db.xml:tt_content.list_type_pi2',
	$_EXTKEY . '_pi2',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');


t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi3']='layout,select_key,pages';


t3lib_extMgm::addPlugin(array(
	'LLL:EXT:sjsh_grandprix/locallang_db.xml:tt_content.list_type_pi3',
	$_EXTKEY . '_pi3',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');
?>