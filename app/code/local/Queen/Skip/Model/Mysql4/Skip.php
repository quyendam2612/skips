<?php
class Queen_Skip_Model_Mysql4_Skip extends Mage_Core_Model_Mysql4_Abstract
{
	protected function _construct()
	{
		$this->_init('queen_skip/skip', 'id');
	}
}