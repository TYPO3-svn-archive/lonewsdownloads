<?php
if (!defined ('TYPO3_MODE')) {
 	die ('Access denied.');
}
if (TYPO3_MODE == 'FE')    {
    require_once(t3lib_extMgm::extPath('lonewsdownloads').'class.tx_lonewsdownloads_hook.php');
}
$TYPO3_CONF_VARS['EXTCONF']['tt_news']['extraItemMarkerHook'][]   = 'tx_lonewsdownloads_hook';
?>