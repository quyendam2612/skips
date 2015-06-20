<?php
class Queen_Skip_Block_Adminhtml_Permit extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function _construct()
	{
		// The blockGroup must match the first half of how we call the block, and controller matches the second half
		// ie. queen_skip/adminhtml_permit
		$this->_blockGroup = 'queen_skip';
		$this->_controller = 'adminhtml_permit';
		$this->_headerText = $this->__('Permit Type');

		parent::__construct();
	}
}