<?php
class Emipro_Customoptions_Model_Mysql4_Assigned_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
	protected function _construct()
	{
		$this->_init('customoptions/assigned');
	}
}