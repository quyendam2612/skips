<?php
class Queen_Skip_Block_Adminhtml_Town extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'queen_skip';
		$this->_controller = 'adminhtml_town';
		$this->_headerText = $this->__('Town');

		parent::__construct();
	}
}