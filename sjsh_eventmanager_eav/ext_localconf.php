<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_sjsheventmanagereav_event=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_sjsheventmanagereav_field=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_sjsheventmanagereav_event_to_field=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_sjsheventmanagereav_Value=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_sjsheventmanagereav_entity=1
');

t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_sjsheventmanagereav_pi1.php', '_pi1', 'list_type', 1);


t3lib_extMgm::addPItoST43($_EXTKEY, 'pi2/class.tx_sjsheventmanagereav_pi2.php', '_pi2', 'list_type', 1);
?>