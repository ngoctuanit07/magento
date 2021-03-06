<?php

/**
 * WDCA - Sweet Tooth
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the WDCA SWEET TOOTH POINTS AND REWARDS 
 * License, which extends the Open Software License (OSL 3.0).

 * The Open Software License is available at this URL: 
 * http://opensource.org/licenses/osl-3.0.php
 * 
 * DISCLAIMER
 * 
 * By adding to, editing, or in any way modifying this code, WDCA is 
 * not held liable for any inconsistencies or abnormalities in the 
 * behaviour of this code. 
 * By adding to, editing, or in any way modifying this code, the Licensee
 * terminates any agreement of support offered by WDCA, outlined in the 
 * provided Sweet Tooth License. 
 * Upon discovery of modified code in the process of support, the Licensee 
 * is still held accountable for any and all billable time WDCA spent 
 * during the support process.
 * WDCA does not guarantee compatibility with any other framework extension. 
 * WDCA is not responsbile for any inconsistencies or abnormalities in the
 * behaviour of this code if caused by other framework extension.
 * If you did not receive a copy of the license, please send an email to 
 * support@sweettoothrewards.com or call 1.855.699.9322, so we can send you a copy 
 * immediately.
 * 
 * @category   [TBT]
 * @package    [TBT_Rewards]
 * @copyright  Copyright (c) 2014 Sweet Tooth Inc. (http://www.sweettoothrewards.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Special Header
 *
 * @category   TBT
 * @package    TBT_Rewards
 * * @author     Sweet Tooth Inc. <support@sweettoothrewards.com>
 */
class TBT_Rewards_Block_WikiHints extends Mage_Core_Block_Template {
	
	private $labelExceptions = array ();
	
	protected function _construct() {
		parent::_construct ();
	}
	
	/*
     * @Returns true only if current locale language is English, false otherwise. 
     */
	
	public function displayWikiHints() {
		$enabled = Mage::getStoreConfig ( 'rewards/WikiHints/is_enabled' );
		if (! $enabled) {
			return false;
		}
		
		$currentLocale = Mage::getSingleton ( 'core/locale' )->getLocaleCode ();
		$_pos = strpos ( $currentLocale, '_' );
		if ($_pos) {
			$lang = substr ( $currentLocale, 0, $_pos );
			if ($lang === "en")
				return true;
		}
		return false;
	}
	
	public function getBaseWikiURL() {
		return Mage::getStoreConfig ( 'rewards/WikiHints/baseURL' );
	}
	
	public function displayWikiHintsOnCurrentPage() {
		/* don't disply WikiHints if we're in the System Config page but not the "rewards" section */
		
		$system_config_section = $this->getRequest ()->getParam ( 'section' );
		if (empty ( $system_config_section )) { // we're not on the user config page, so ok to display
			return true;
		} else { // we're on the config page
			if ($system_config_section == "rewards") {
				return true; // we're on the rewards config page
			} else {
				return false; // we're on some other config page
			}
		}
	}
	
	/*
     * @param labelToSkip adds label to be ignored by WikiHints. Allows unlimited parameters. Must be called before page is loaded!
     */
	
	public function addLabelException() {
		$args = func_get_args ();
		foreach ( $args as $labelToSkip ) {
			$this->labelExceptions [] = $labelToSkip;
		}
	}
	
	/*
     * @Returns javascript code to process label exceptions in WikiHints
     */
	
	public function getLabelExceptionsJavascript() {
		$javascriptCode = "";
		foreach ( $this->labelExceptions as $index => $labelToSkip ) {
			$javascriptCode .= "addLabelException('$labelToSkip'); \n";
		}
		return $javascriptCode;
	}

}