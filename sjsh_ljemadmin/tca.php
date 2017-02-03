<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_sjshljemadmin_aks'] = array (
	'ctrl' => $TCA['tx_sjshljemadmin_aks']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,sort,u,jahrgang,jahrgang2,runden,modus,staffel'
	),
	'feInterface' => $TCA['tx_sjshljemadmin_aks']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'sort' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_aks.sort',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'u' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_aks.u',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'jahrgang' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_aks.jahrgang',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'jahrgang2' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_aks.jahrgang2',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'runden' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_aks.runden',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'modus' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_aks.modus',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'staffel' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_aks.staffel',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, sort, u, jahrgang, jahrgang2, runden, modus, staffel')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_sjshljemadmin_ergebnisse'] = array (
	'ctrl' => $TCA['tx_sjshljemadmin_ergebnisse']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,klasse,runde,tisch,id1,id2,erg1,erg2,flag'
	),
	'feInterface' => $TCA['tx_sjshljemadmin_ergebnisse']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'klasse' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_ergebnisse.klasse',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'runde' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_ergebnisse.runde',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'tisch' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_ergebnisse.tisch',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'id1' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_ergebnisse.id1',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'id2' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_ergebnisse.id2',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'erg1' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_ergebnisse.erg1',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'erg2' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_ergebnisse.erg2',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'flag' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_ergebnisse.flag',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, klasse, runde, tisch, id1, id2, erg1, erg2, flag')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_sjshljemadmin_spieler'] = array (
	'ctrl' => $TCA['tx_sjshljemadmin_spieler']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,name,attr,elo,dwz,verein,jahr,foto,rang,punkte,punktebuch,buch,soberg,buchsum,s,r,v'
	),
	'feInterface' => $TCA['tx_sjshljemadmin_spieler']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'name' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_spieler.name',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'attr' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_spieler.attr',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'elo' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_spieler.elo',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'dwz' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_spieler.dwz',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'verein' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_spieler.verein',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'jahr' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_spieler.jahr',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'foto' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_spieler.foto',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'rang' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_spieler.rang',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'punkte' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_spieler.punkte',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'punktebuch' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_spieler.punktebuch',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'buch' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_spieler.buch',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'soberg' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_spieler.soberg',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'buchsum' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_spieler.buchsum',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		's' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_spieler.s',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'r' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_spieler.r',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'v' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_ljemadmin/locallang_db.xml:tx_sjshljemadmin_spieler.v',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, name, attr, elo, dwz, verein, jahr, foto, rang, punkte, punktebuch, buch, soberg, buchsum, s, r, v')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);
?>