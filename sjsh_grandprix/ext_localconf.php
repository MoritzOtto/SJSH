<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_sjshgrandprix_gp_AK=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_sjshgrandprix_gp_Punkte=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_sjshgrandprix_gp_Spieler=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_sjshgrandprix_gp_Turnier=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_sjshgrandprix_gp_Verein=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_sjshgrandprix_gp_AgeClassToPlayer=1
');

t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_sjshgrandprix_pi1.php', '_pi1', 'list_type', 1);


t3lib_extMgm::addPItoST43($_EXTKEY, 'pi2/class.tx_sjshgrandprix_pi2.php', '_pi2', 'list_type', 1);


t3lib_extMgm::addPItoST43($_EXTKEY, 'pi3/class.tx_sjshgrandprix_pi3.php', '_pi3', 'list_type', 1);
?>