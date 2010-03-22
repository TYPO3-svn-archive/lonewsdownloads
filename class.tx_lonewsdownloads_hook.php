<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2006 Georg Ringer <typo3@ringerge.org>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * Hook 'lonewsdownloads_hook' for the 'tt_news' extension.
 *
 * @author	Lina Ourima <typo3 et ringerge dot org>
 * @sponsorship typo3-blog.net (http://www.typo3-blog.net/) 
 */


require_once(PATH_tslib.'class.tslib_pibase.php');
require_once(PATH_t3lib.'class.t3lib_tcemain.php');


class tx_lonewsdownloads_hook extends tslib_pibase {
	var $cObj; // The backReference to the mother cObj object set at call time
	// Default plugin variables:
	var $prefixId 		= 'tx_lonewsdownloads';		// Same as class name
	var $scriptRelPath 	= 'class.tx_lonewsdownloads_hook.php';	// Path to this script relative to the extension dir.
	var $extKey 		= 'lonewsdownloads';	// The extension key.

	var $pObj;
	var $conf;
	var $markerArray;
	var $calledBy;


	/**
	 * connects into the tt_news to fill the 2 markers
	 *
	 * @param	array		an array of markers coming from the extension
	 * @param	array		the current record of the extension
	 * @param	array		the configuration coming from the extension
	 * @param	object		the parent object calling this method
	 * @return	array		processed marker array
	 */
	function extraItemMarkerProcessor($markerArray, $row, $lConf, &$pObj) {
		$this->cObj = t3lib_div::makeInstance('tslib_cObj'); // local cObj.	
		$this->pObj = &$pObj;
		$this2 = $pObj;
		$conf = $pObj->conf;
		$confLinks = $conf['lonewsdownloads.'];
		
		
		if(!$confLinks['download_single'])
		{
		  $markerArray['###LO_DOWNLOADS###']= 'Please include static TypoScript of LONewsDownloads or remove marker. "###LO_DOWNLOADS###"';
		  return $markerArray;
		}
		$downloads = '';
		if(t3lib_extMgm::isLoaded('dam')) {
			if(t3lib_extMgm::isLoaded('dam_ttnews')) {
				$row = $pObj->local_cObj->data;
				//workspaces
				if (isset($row['_ORIG_uid']) && ($row['_ORIG_uid'] > 0)) {
							// draft workspace
							$uid = $row['_ORIG_uid'];
				} else {
							// live workspace
							$uid = $row['uid'];
				}
				// Check for translation
				if ($row['_LOCALIZED_UID']) {
				 $uid = $row['_LOCALIZED_UID'];
				}
				$damFiles = tx_dam_db::getReferencedFiles('tt_news', $uid, 'tx_damnews_dam_media' );
				$files = $damFiles['files'];
				$fileData = $damFiles['rows'];
				//t3lib_div::debug($damFiles);
			} else {
				$markerArray['###LO_DOWNLOADS###']= 'DAM not supportet, please install dam_ttnews';
				return $markerArray;
			}
		}
		else {            
			# Prevents output if no file was selected, thanks to Jeroen Vreuls
			$files = array();
			if (!empty($row['news_files'])) {
				$files = explode(',',$row['news_files']);
				$lables = explode("\n",$row['tx_lonewsdownloads_downloadlabel']);
				$fileData = array();
				foreach($files AS $key => $file) {
					$pathinfo =  pathinfo('uploads/media/'.$file);
				//	t3lib_div::debug($pathinfo);
					$lables[$key] = trim($lables[$key]);
					$fileData[$key]['title'] = $lables[$key]?$lables[$key]:$pathinfo['filename'];
					$fileData[$key]['file_size'] = filesize('uploads/media/'.$file);
					$fileData[$key]['file_type'] = strtolower($pathinfo['extension']);
					$files[$key] = 'uploads/media/'.$file;
				}
			}
		}
		$local_cObj = t3lib_div::makeInstance('tslib_cObj');
		$local_data = $this->cObj->data;
		$local_data = $row;
		foreach($files AS $key => $file) {
			if(is_array($fileData[$key])) {
				foreach($fileData[$key] AS $keyD => $valueD) {
					$local_data['single_news_file_'.$keyD] = $valueD;
				}
			}
			$local_data['single_news_file_file_size_Byte'] = intval($local_data['single_news_file_file_size']);
			$local_data['single_news_file_file_size_kB'] = round($local_data['single_news_file_file_size'] / 1024);
			$local_data['single_news_file_file_size_MB'] = round($local_data['single_news_file_file_size'] / 1024 / 1024);
			if($local_data['single_news_file_file_size_MB'] > 0) {
				$local_data['single_news_file_file_size'] = $local_data['single_news_file_file_size_MB'].' MB';
			} else if($local_data['single_news_file_file_size_kB'] > 0) {
				$local_data['single_news_file_file_size'] = $local_data['single_news_file_file_size_kB'].' kB';
			} else {
				$local_data['single_news_file_file_size'] = $local_data['single_news_file_file_size_Byte'].' Byte';
			}
			
			$local_data['single_news_file'] = $file;
		  $local_cObj->data = $local_data;
			$downloads .= $local_cObj->cObjGetSingle($confLinks['download_single'], $confLinks['download_single.']);
		}
		
		$local_data['lodownload_list'] = $downloads;
		$local_cObj->data = $local_data;
		$markerArray['###LO_DOWNLOADS###']= $local_cObj->cObjGetSingle($confLinks['download_list'], $confLinks['download_list.']);
		return $markerArray;
	}

}
?>