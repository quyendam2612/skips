<?php
class Queen_Skip_Block_Adminhtml_Town_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	/**
	 * Init class
	 */
	public function __construct()
	{
		$this->_blockGroup = 'queen_skip';
		$this->_controller = 'adminhtml_town';

		parent::__construct();

		$this->_updateButton('save', 'label', $this->__('Save Town'));
		$this->_updateButton('delete', 'label', $this->__('Delete Town'));
	}

	/**
	 * Get Header text
	 *
	 * @return string
	 */
	public function getHeaderText()
	{
		if (Mage::registry('queen_skip')->getId()) {
			return $this->__('Edit Town');
		}
		else {
			return $this->__('New Town');
		}
	}
}