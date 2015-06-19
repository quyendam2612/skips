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
class Emipro_Customoptions_Model_Product extends Mage_Catalog_Model_Product
{
    public function delete()
    {		
		$feature_id = Mage::getModel('catalog/product')->getIdBySku('customoptionmaster');

		if($this->getId() == $feature_id) {
			Mage::throwException('You can not Delete this Product');
		} else {
		    parent::delete();
		    Mage::dispatchEvent($this->_eventPrefix.'_delete_after_done', array($this->_eventObject=>$this));
		    return $this;
		}
    }
}
