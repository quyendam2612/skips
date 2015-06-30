<?php
class Queen_Skip_Block_Adminhtml_Skip extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'queen_skip';
		$this->_controller = 'adminhtml_skip';
		$this->_headerText = $this->__('Collection');

		parent::__construct();
	}
}