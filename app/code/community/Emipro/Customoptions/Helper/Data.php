<?php
/*
 * //////////////////////////////////////////////////////////////////////////////////////
 *
 * @author Emipro Technologies
 * @Category Emipro
 * @package Emipro_Customoptions
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 * //////////////////////////////////////////////////////////////////////////////////////
 */
class Emipro_Customoptions_Helper_Data extends Mage_Core_Helper_Abstract
{
    protected $_customOptionInstance;

    public function getCustomOptionInstance()
    {
        if (!$this->_customOptionInstance) {
            $this->_customOptionInstance = Mage::registry('customoptionload_data');

            if (!$this->_customOptionInstance) {
                Mage::throwException($this->__('Custom Option instance does not exist in Registry'));
            }
        }

        return $this->_customOptionInstance;
    }    

    public function saveAssigned($optionId, $skuvalue = null, $categories = null)
    {
        $assigned = Mage::getModel('customoptions/assigned')->getCollection()
            ->addFieldToFilter('option_id', array('eq' => $optionId));
        if (sizeof($assigned))
        {
            $assigned = $assigned->getFirstItem();
            if (!is_null($skuvalue))
            {
                $assigned->setSkus($skuvalue);
            }
            if (!is_null($categories))
            {
                $assigned->setCategories($categories);
            }
        } else {
            $assigned = Mage::getModel('customoptions/assigned');
            $assigned->setOptionId($optionId);
            if (!is_null($skuvalue))
            {
                $assigned->setSkus($skuvalue);
            }
            if (!is_null($categories))
            {
                $assigned->setCategories($categories);
            }
        }
        $assigned->save();
    }

    public function getAssignedCats()
    {
        $optionId = Mage::app()->getRequest()->getParam('id');
        $value = array();
        if ($optionId) {
            $assigned = Mage::getModel('customoptions/assigned')->getCollection()
                ->addFieldToFilter('option_id', array('eq' => $optionId));
            if (sizeof($assigned))
            {
                $assigned = $assigned->getFirstItem();
                $value = explode(',', $assigned->getCategories());
            }
        }

        return $value;
    }
}
	 
