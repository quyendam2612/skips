<?php
class Queen_Skip_Block_Adminhtml_Postcode_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	/**
	 * Init class
	 */
	public function __construct()
	{
		$this->_blockGroup = 'queen_skip';
		$this->_controller = 'adminhtml_postcode';

		parent::__construct();

		$this->_updateButton('save', 'label', $this->__('Save Postcode'));
		$this->_updateButton('delete', 'label', $this->__('Delete Postcode'));
	}

	/**
	 * Get Header text
	 *
	 * @return string
	 */
	public function getHeaderText()
	{
		if (Mage::registry('queen_skip')->getId()) {
			return $this->__('Edit Postcode');
		}
		else {
			return $this->__('New Postcode');
		}
	}
}