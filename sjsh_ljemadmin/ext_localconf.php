<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_sjshljemadmin_aks=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_sjshljemadmin_spieler=1
');

t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_sjshljemadmin_pi1.php', '_pi1', 'list_type', 1);


t3lib_extMgm::addPItoST43($_EXTKEY, 'pi2/class.tx_sjshljemadmin_pi2.php', '_pi2', 'list_type', 1);


t3lib_extMgm::addPItoST43($_EXTKEY, 'pi3/class.tx_sjshljemadmin_pi3.php', '_pi3', 'list_type', 1);


t3lib_extMgm::addPItoST43($_EXTKEY, 'pi4/class.tx_sjshljemadmin_pi4.php', '_pi4', 'list_type', 1);


t3lib_extMgm::addPItoST43($_EXTKEY, 'pi5/class.tx_sjshljemadmin_pi5.php', '_pi5', 'list_type', 1);
?>