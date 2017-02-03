<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_sjshdates_tbldates'] = array (
	'ctrl' => $TCA['tx_sjshdates_tbldates']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,name,ausrichter,begin,end,location,url,sh'
	),
	'feInterface' => $TCA['tx_sjshdates_tbldates']['feInterface'],
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
			'label' => 'LLL:EXT:sjsh_dates/locallang_db.xml:tx_sjshdates_tbldates.name',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'ausrichter' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_dates/locallang_db.xml:tx_sjshdates_tbldates.ausrichter',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'begin' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_dates/locallang_db.xml:tx_sjshdates_tbldates.begin',		
			'config' => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'checkbox' => '0',
				'default'  => '0'
			)
		),
		'end' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_dates/locallang_db.xml:tx_sjshdates_tbldates.end',		
			'config' => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'checkbox' => '0',
				'default'  => '0'
			)
		),
		'location' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_dates/locallang_db.xml:tx_sjshdates_tbldates.location',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'url' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_dates/locallang_db.xml:tx_sjshdates_tbldates.url',		
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
		'sh' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_dates/locallang_db.xml:tx_sjshdates_tbldates.sh',		
			'config' => array (
				'type' => 'check',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, name, ausrichter, begin, end, location, url, sh')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	),
);
?>