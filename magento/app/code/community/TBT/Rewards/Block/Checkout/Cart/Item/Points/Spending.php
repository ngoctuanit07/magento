<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Checkout
 * @copyright   Copyright (c) 2008 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Shopping cart item render block
 *
 * @category    Mage
 * @package     Mage_Checkout
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class TBT_Rewards_Block_Checkout_Cart_Item_Points_Spending extends TBT_Rewards_Block_Checkout_Cart_Item_Points {
	
	protected function _beforeToHtml() {
		if (!$this->getParentBlock()) {
			return parent::_beforeToHtml();
		}
		
		$hideSpendingsForItem = $this->getParentBlock()->getHideSpendingsForItem();
		$this->setHideSpendingsForItem($hideSpendingsForItem);
		if (!$hideSpendingsForItem) {
			if (!$this->getParentBlock()->getParentBlock()) {
				return parent::_beforeToHtml();
			}
			
			$hideSpendingsForItem = $this->getParentBlock()->getParentBlock()->getHideSpendingsForItem();
			$this->setHideSpendingsForItem($hideSpendingsForItem);
		}
		
		return parent::_beforeToHtml();
	}
	
	protected function _toHtml() {
		if ($this->getHideSpendingsForItem()) {
			return "";
		}
		return parent::_toHtml();
	}
}