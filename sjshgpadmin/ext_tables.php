<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'SJSH.' . $_EXTKEY,   // vendor + extkey, seperated by a dot
		'web',                      // Backend Module group to place the module in
		'management',               // module name
		'',                         // position in the group
		array(                      // Allowed controller -> action combinations
			'SjshGpadmin' => 'index, save'
		),
		array(                      // Additional configuration
			'access' => 'user,group',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_gpadmin.xlf',
		)
	);

}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'SJSH');
