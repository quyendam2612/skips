<?php
class Emipro_Customoptions_Model_Mysql4_Assigned extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('customoptions/assigned', 'id');
    }
}