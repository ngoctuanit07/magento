<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Advancedreports
 * @version    2.6.3
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class AW_Advancedreports_Model_Form_Element_Select extends Varien_Data_Form_Element_Select
{
    public function getElementHtml()
    {
        $this->_data['disabled'] = Mage::helper('advancedreports/setup')->isDefault($this->getId());
        return parent::getElementHtml() . $this->_getDefaultCheckbox();
    }

    protected function _getDefaultCheckbox()
    {
        $html = '</td><td class="value use-default">';
        $html .= Mage::helper('advancedreports/setup')->getCheckboxScopeHtml(
            $this, $this->getFieldName(), $this->getDisabled()
        );
        return $html;
    }
}