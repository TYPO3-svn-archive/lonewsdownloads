<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}
$tempColumns = array (
	'tx_lonewsdownloads_downloadlabel' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:lonewsdownloads/locallang_db.xml:tt_news.tx_lonewsdownloads_downloadlabel',		
		'config' => array (
			'type' => 'text',
			'cols' => '30',	
			'rows' => '5',
		)
	),
);


t3lib_div::loadTCA('tt_news');
t3lib_extMgm::addTCAcolumns('tt_news',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('tt_news','tx_lonewsdownloads_downloadlabel;;;;1-1-1', '', 'before:news_files');

t3lib_extMgm::addStaticFile($_EXTKEY,'static/tt_news_download/', 'tt_news Download');
?>