<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_sjshgrandprix_gp_AK'] = array (
	'ctrl' => $TCA['tx_sjshgrandprix_gp_AK']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,ak_name'
	),
	'feInterface' => $TCA['tx_sjshgrandprix_gp_AK']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'ak_name' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_AK.ak_name',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, ak_name')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_sjshgrandprix_gp_Punkte'] = array (
	'ctrl' => $TCA['tx_sjshgrandprix_gp_Punkte']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,spieler_id,turnier_id,punkte'
	),
	'feInterface' => $TCA['tx_sjshgrandprix_gp_Punkte']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'spieler_id' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_Punkte.spieler_id',		
			'config' => array (
				'type' => 'select',	
				'foreign_table' => 'tx_sjshgrandprix_gp_Spieler',	
				'foreign_table_where' => 'ORDER BY tx_sjshgrandprix_gp_Spieler.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,	
				'wizards' => array(
					'_PADDING'  => 2,
					'_VERTICAL' => 1,
					'add' => array(
						'type'   => 'script',
						'title'  => 'Create new record',
						'icon'   => 'add.gif',
						'params' => array(
							'table'    => 'tx_sjshgrandprix_gp_Spieler',
							'pid'      => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
					'list' => array(
						'type'   => 'script',
						'title'  => 'List',
						'icon'   => 'list.gif',
						'params' => array(
							'table' => 'tx_sjshgrandprix_gp_Spieler',
							'pid'   => '###CURRENT_PID###',
						),
						'script' => 'wizard_list.php',
					),
					'edit' => array(
						'type'                     => 'popup',
						'title'                    => 'Edit',
						'script'                   => 'wizard_edit.php',
						'popup_onlyOpenIfSelected' => 1,
						'icon'                     => 'edit2.gif',
						'JSopenParams'             => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				),
			)
		),
		'turnier_id' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_Punkte.turnier_id',		
			'config' => array (
				'type' => 'select',	
				'foreign_table' => 'tx_sjshgrandprix_gp_Turnier',	
				'foreign_table_where' => 'ORDER BY tx_sjshgrandprix_gp_Turnier.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,	
				'wizards' => array(
					'_PADDING'  => 2,
					'_VERTICAL' => 1,
					'add' => array(
						'type'   => 'script',
						'title'  => 'Create new record',
						'icon'   => 'add.gif',
						'params' => array(
							'table'    => 'tx_sjshgrandprix_gp_Turnier',
							'pid'      => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
					'list' => array(
						'type'   => 'script',
						'title'  => 'List',
						'icon'   => 'list.gif',
						'params' => array(
							'table' => 'tx_sjshgrandprix_gp_Turnier',
							'pid'   => '###CURRENT_PID###',
						),
						'script' => 'wizard_list.php',
					),
					'edit' => array(
						'type'                     => 'popup',
						'title'                    => 'Edit',
						'script'                   => 'wizard_edit.php',
						'popup_onlyOpenIfSelected' => 1,
						'icon'                     => 'edit2.gif',
						'JSopenParams'             => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				),
			)
		),
		'punkte' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_Punkte.punkte',		
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000',
					'lower' => '1'
				),
				'default' => 0
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, spieler_id, turnier_id, punkte')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_sjshgrandprix_gp_Spieler'] = array (
	'ctrl' => $TCA['tx_sjshgrandprix_gp_Spieler']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,spieler_name,spieler_vorname,verein_id',
		'label' => 'spieler_vorname',
      'label_alt' => 'spieler_name',
      'label_alt_force' => 1
	),
	'feInterface' => $TCA['tx_sjshgrandprix_gp_Spieler']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'spieler_name' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_Spieler.spieler_name',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'spieler_vorname' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_Spieler.spieler_vorname',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'verein_id' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_Spieler.verein_id',		
			'config' => array (
				'type' => 'select',	
				'foreign_table' => 'tx_sjshgrandprix_gp_Verein',	
				'foreign_table_where' => 'ORDER BY tx_sjshgrandprix_gp_Verein.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, spieler_name, spieler_vorname, verein_id')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_sjshgrandprix_gp_Turnier'] = array (
	'ctrl' => $TCA['tx_sjshgrandprix_gp_Turnier']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,turnier_ort,turnier_veranstalter,turnier_date,turnier_ergebnisse,turnier_ausschreibung'
	),
	'feInterface' => $TCA['tx_sjshgrandprix_gp_Turnier']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'turnier_ort' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_Turnier.turnier_ort',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'turnier_veranstalter' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_Turnier.turnier_veranstalter',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'turnier_date' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_Turnier.turnier_date',		
			'config' => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'checkbox' => '0',
				'default'  => '0'
			)
		),
		'turnier_ergebnisse' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_Turnier.turnier_ergebnisse',		
			'config' => array (
				'type'     => 'input',
				'size'     => '15',
				'max'      => '255',
				'checkbox' => '',
				'eval'     => 'trim',
				'wizards'  => array(
					'_PADDING' => 2,
					'link'     => array(
						'type'         => 'popup',
						'title'        => 'Link',
						'icon'         => 'link_popup.gif',
						'script'       => 'browse_links.php?mode=wizard',
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
					)
				)
			)
		),
		'turnier_ausschreibung' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_Turnier.turnier_ausschreibung',		
			'config' => array (
				'type'     => 'input',
				'size'     => '15',
				'max'      => '255',
				'checkbox' => '',
				'eval'     => 'trim',
				'wizards'  => array(
					'_PADDING' => 2,
					'link'     => array(
						'type'         => 'popup',
						'title'        => 'Link',
						'icon'         => 'link_popup.gif',
						'script'       => 'browse_links.php?mode=wizard',
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
					)
				)
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, turnier_ort, turnier_veranstalter, turnier_date, turnier_ergebnisse, turnier_ausschreibung')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_sjshgrandprix_gp_Verein'] = array (
	'ctrl' => $TCA['tx_sjshgrandprix_gp_Verein']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,verein_name'
	),
	'feInterface' => $TCA['tx_sjshgrandprix_gp_Verein']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'verein_name' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_Verein.verein_name',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, verein_name')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_sjshgrandprix_gp_AgeClassToPlayer'] = array (
	'ctrl' => $TCA['tx_sjshgrandprix_gp_AgeClassToPlayer']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,gp_ageclass,gp_player,year'
	),
	'feInterface' => $TCA['tx_sjshgrandprix_gp_AgeClassToPlayer']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'gp_ageclass' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_AgeClassToPlayer.gp_ageclass',		
			'config' => array (
				'type' => 'select',	
				'foreign_table' => 'tx_sjshgrandprix_gp_AK',	
				'foreign_table_where' => 'ORDER BY tx_sjshgrandprix_gp_AK.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,	
				'wizards' => array(
					'_PADDING'  => 2,
					'_VERTICAL' => 1,
					'add' => array(
						'type'   => 'script',
						'title'  => 'Create new record',
						'icon'   => 'add.gif',
						'params' => array(
							'table'    => 'tx_sjshgrandprix_gp_AK',
							'pid'      => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
					'list' => array(
						'type'   => 'script',
						'title'  => 'List',
						'icon'   => 'list.gif',
						'params' => array(
							'table' => 'tx_sjshgrandprix_gp_AK',
							'pid'   => '###CURRENT_PID###',
						),
						'script' => 'wizard_list.php',
					),
					'edit' => array(
						'type'                     => 'popup',
						'title'                    => 'Edit',
						'script'                   => 'wizard_edit.php',
						'popup_onlyOpenIfSelected' => 1,
						'icon'                     => 'edit2.gif',
						'JSopenParams'             => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				),
			)
		),
		'gp_player' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_AgeClassToPlayer.gp_player',		
			'config' => array (
				'type' => 'select',	
				'foreign_table' => 'tx_sjshgrandprix_gp_Spieler',	
				'foreign_table_where' => 'ORDER BY tx_sjshgrandprix_gp_Spieler.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,	
				'wizards' => array(
					'_PADDING'  => 2,
					'_VERTICAL' => 1,
					'add' => array(
						'type'   => 'script',
						'title'  => 'Create new record',
						'icon'   => 'add.gif',
						'params' => array(
							'table'    => 'tx_sjshgrandprix_gp_Spieler',
							'pid'      => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
					'list' => array(
						'type'   => 'script',
						'title'  => 'List',
						'icon'   => 'list.gif',
						'params' => array(
							'table' => 'tx_sjshgrandprix_gp_Spieler',
							'pid'   => '###CURRENT_PID###',
						),
						'script' => 'wizard_list.php',
					),
					'edit' => array(
						'type'                     => 'popup',
						'title'                    => 'Edit',
						'script'                   => 'wizard_edit.php',
						'popup_onlyOpenIfSelected' => 1,
						'icon'                     => 'edit2.gif',
						'JSopenParams'             => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				),
			)
		),
		'year' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_grandprix/locallang_db.xml:tx_sjshgrandprix_gp_AgeClassToPlayer.year',		
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '5000',
					'lower' => '10'
				),
				'default' => 0
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, gp_ageclass, gp_player, year')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);
?>