<?php
if (!defined ('TYPO3_MODE')) die('Access denied.');

// Extra markers hook for tt_news
if (t3lib_extMgm::isLoaded('tt_news')) {
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tt_news']['extraItemMarkerHook'][$_EXTKEY] = 'EXT:lonewsdownloads/class.tx_lonewsdownloads_hook.php:&tx_lonewsdownloads_hook';
}
?>