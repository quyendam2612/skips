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


}
	 
