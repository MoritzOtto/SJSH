<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_sjsheventmanagereav_event'] = array (
	'ctrl' => $TCA['tx_sjsheventmanagereav_event']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,name,displayname'
	),
	'feInterface' => $TCA['tx_sjsheventmanagereav_event']['feInterface'],
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
			'label' => 'LLL:EXT:sjsh_eventmanager_eav/locallang_db.xml:tx_sjsheventmanagereav_event.name',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required',
			)
		),
		'displayname' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_eventmanager_eav/locallang_db.xml:tx_sjsheventmanagereav_event.displayname',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, name, displayname')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_sjsheventmanagereav_field'] = array (
	'ctrl' => $TCA['tx_sjsheventmanagereav_field']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,name'
	),
	'feInterface' => $TCA['tx_sjsheventmanagereav_field']['feInterface'],
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
			'label' => 'LLL:EXT:sjsh_eventmanager_eav/locallang_db.xml:tx_sjsheventmanagereav_field.name',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, name')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_sjsheventmanagereav_event_to_field'] = array (
	'ctrl' => $TCA['tx_sjsheventmanagereav_event_to_field']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,idfield,idevent'
	),
	'feInterface' => $TCA['tx_sjsheventmanagereav_event_to_field']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'idfield' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_eventmanager_eav/locallang_db.xml:tx_sjsheventmanagereav_event_to_field.idfield',		
			'config' => array (
				'type' => 'group',	
				'internal_type' => 'db',	
				'allowed' => 'tx_sjsheventmanagereav_field',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'idevent' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_eventmanager_eav/locallang_db.xml:tx_sjsheventmanagereav_event_to_field.idevent',		
			'config' => array (
				'type' => 'group',	
				'internal_type' => 'db',	
				'allowed' => 'pages',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, idfield, idevent')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_sjsheventmanagereav_Value'] = array (
	'ctrl' => $TCA['tx_sjsheventmanagereav_Value']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,entity,field,value'
	),
	'feInterface' => $TCA['tx_sjsheventmanagereav_Value']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'entity' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_eventmanager_eav/locallang_db.xml:tx_sjsheventmanagereav_Value.entity',		
			'config' => array (
				'type' => 'group',	
				'internal_type' => 'db',	
				'allowed' => 'tx_sjsheventmanagereav_entity',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'field' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_eventmanager_eav/locallang_db.xml:tx_sjsheventmanagereav_Value.field',		
			'config' => array (
				'type' => 'group',	
				'internal_type' => 'db',	
				'allowed' => 'tx_sjsheventmanagereav_field',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'value' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sjsh_eventmanager_eav/locallang_db.xml:tx_sjsheventmanagereav_Value.value',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, entity, field, value')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_sjsheventmanagereav_entity'] = array (
	'ctrl' => $TCA['tx_sjsheventmanagereav_entity']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,name'
	),
	'feInterface' => $TCA['tx_sjsheventmanagereav_entity']['feInterface'],
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
			'label' => 'LLL:EXT:sjsh_eventmanager_eav/locallang_db.xml:tx_sjsheventmanagereav_entity.name',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, name')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);
?>