<?php
class Queen_Skip_Model_Mysql4_Skip_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
	protected function _construct()
	{
		$this->_init('queen_skip/skip');
	}
}