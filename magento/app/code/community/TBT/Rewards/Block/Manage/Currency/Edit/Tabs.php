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
 * Manage Currency Edit Tabs
 *
 * @category   TBT
 * @package    TBT_Rewards
 * * @author     Sweet Tooth Inc. <support@sweettoothrewards.com>
 */
class TBT_Rewards_Block_Manage_Currency_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {
	
	public function __construct() {
		parent::__construct ();
		$this->setId ( 'currency_tabs' );
		$this->setDestElementId ( 'edit_form' );
		$this->setTitle ( Mage::helper ( 'rewards' )->__ ( 'Points Currency Information' ) );
	}
	
	protected function _beforeToHtml() {
		$this->addTab ( 'info_section', array ('label' => Mage::helper ( 'rewards' )->__ ( 'Currency Information' ), 'title' => Mage::helper ( 'rewards' )->__ ( 'Currency Information' ), 'content' => $this->getLayout ()->createBlock ( 'rewards/manage_currency_edit_tab_form' )->toHtml () ) );
		
		$this->addTab ( 'appearance_section', array ('label' => Mage::helper ( 'rewards' )->__ ( 'Points Appearance' ), 'title' => Mage::helper ( 'rewards' )->__ ( 'Points Appearance' ), 'content' => $this->getLayout ()->createBlock ( 'rewards/manage_currency_edit_tab_appearance' )->toHtml () ) );
		
		return parent::_beforeToHtml ();
	}

}