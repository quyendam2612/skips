<?php
/*
 * //////////////////////////////////////////////////////////////////////////////////////
 *
 * @author Emipro Technologies
 * @Category Emipro
 * @package Emipro_Customoptions
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 * //////////////////////////////////////////////////////////////////////////////////////
 */
class Emipro_Customoptions_Block_Adminhtml_Customoptions extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_customoptions";
	$this->_blockGroup = "customoptions";
	$this->_headerText = Mage::helper("customoptions")->__("Manage Custom Options");
	parent::__construct();
	$this->removeButton("add");	
	}

}
