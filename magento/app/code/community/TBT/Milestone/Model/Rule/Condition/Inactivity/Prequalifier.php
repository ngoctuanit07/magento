<?php

/**
 * @method TBT_Milestone_Model_Rule getRule()
 * @method self setRule(TBT_Milestone_Model_Rule $rule)
 *
 */
class TBT_Milestone_Model_Rule_Condition_Inactivity_Prequalifier extends Varien_Object
{
    /**
     * Will produce a prequalified collection of customers who are elligable for the rule in this model.
     * @throws Exception if no rule set in the model.
     * @return Varien_Data_Collection
     */
    public function getCollection()
    {
        $rule = $this->getRule();
        $collection = Mage::getModel('rewards/customer')->getCollection()
                                                        ->addLastLoginToSelect($rule->getStoreIds());        
        if (empty($rule)){
            throw new Exception(__CLASS__ . " needs a rule which hasn't been set yet.");    
        }
        
        if (!$rule->getId() || !$rule->getIsEnabled()){
            return new Varien_Data_Collection();
        }
        
        $threshold = intval($rule->getCondition()->getThreshold());
        $fromDate = $rule->getCondition()->getFromDate();
        $toDate = $rule->getCondition()->getToDate();
        $today = Mage::helper('tbtmilestone')->getLocalMidnightInUtcTimestamp();
        
        if ($today < strtotime($fromDate) ||
            (!empty($toDate) && $today > strtotime($toDate))){
            /*
             * If it's before the start date or after the end date,
             * no one qualifies.
             */
            return new Varien_Data_Collection();
        } 
        
        /**
         * The idea is, a customer is eligible for this rule only if:
         * 
         * - their account has not been disabled
         * - they are in the correct customer group
         * - they are a member of the correct website
         * - they haven't logged in for the past X days (from today)
         * - they have not already been inactive for X number of days before the start of this rule
         *  
         */

        $targetCutOff = array();
        $targetCutOff['today'] = Mage::helper('tbtmilestone')->getDateStringXDaysAgo($threshold - 1);
        $targetCutOff['rule_start'] = Mage::helper('tbtmilestone')->getDateStringXDaysAgo($threshold, $fromDate);        
        

        $collection->addFieldToFilter('is_active', true);
        $collection->addFieldToFilter('group_id', array('in' => $rule->getCustomerGroupIds()));
        $collection->addFieldToFilter('website_id', array('in' => $rule->getWebsiteIds()));       
        
        $collection->getSelect()->having("`last_login` < '{$targetCutOff['today']}'");
        $collection->getSelect()->having("`last_login` >= '{$targetCutOff['rule_start']}'");
        
        return $collection;
    }  
}