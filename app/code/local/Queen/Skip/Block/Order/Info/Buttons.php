<?php
class Queen_Skip_Block_Order_Info_Buttons extends Mage_Sales_Block_Order_Info_Buttons
{
	protected function _construct()
	{
		parent::_construct();
		$this->setTemplate('skip/sales/order/info/buttons.phtml');
	}
}