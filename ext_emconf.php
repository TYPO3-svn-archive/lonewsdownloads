<?php

########################################################################
# Extension Manager/Repository config file for ext "lonewsdownloads".
#
# Auto generated 24-07-2010 16:53
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Better Downloads for tt_news',
	'description' => 'TypoScript configurable tt_news Download with additional label field. Replaces marker ###LO_DOWNLOADS###.',
	'category' => 'fe',
	'shy' => 0,
	'version' => '2.1.0',
	'dependencies' => 'tt_news',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => 'tt_news',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Lina Wolf',
	'author_email' => '2010@lotypo3.de',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'tt_news' => '',
			'php' => '5.2.0-6.0.0',
			'typo3' => '4.2.0-4.4.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:18:{s:9:"ChangeLog";s:4:"473d";s:10:"README.txt";s:4:"ee2d";s:33:"class.tx_lonewsdownloads_hook.php";s:4:"ccc0";s:9:"error_log";s:4:"2779";s:21:"ext_conf_template.txt";s:4:"143c";s:12:"ext_icon.gif";s:4:"356c";s:17:"ext_localconf.php";s:4:"e41c";s:14:"ext_tables.php";s:4:"2ec8";s:14:"ext_tables.sql";s:4:"389a";s:16:"locallang_db.xml";s:4:"5529";s:14:"doc/manual.sxw";s:4:"194f";s:19:"doc/wizard_form.dat";s:4:"5264";s:20:"doc/wizard_form.html";s:4:"3aae";s:32:"res/lonewsdownloadsTemplate.html";s:4:"3f46";s:37:"static/tt_news_download/constants.txt";s:4:"e996";s:33:"static/tt_news_download/setup.txt";s:4:"7905";s:48:"static/tt_news_download_simplelist/constants.txt";s:4:"62e0";s:44:"static/tt_news_download_simplelist/setup.txt";s:4:"4df5";}',
	'suggests' => array(
	),
);

?>