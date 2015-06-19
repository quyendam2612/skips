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
class Emipro_Customoptions_Block_Adminhtml_Categoryoptions_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId('categoryoptions_tabs');
				$this->setDestElementId('edit_form');
				$this->setTitle(Mage::helper('customoptions')->__('Custom option manager'));
		}
		protected function _beforeToHtml()
		{ 	
				$this->addTab('category_section', array(
				'label' => Mage::helper('customoptions')->__('Assign to Category'),
				'title' => Mage::helper('customoptions')->__('Assign to Category'),
				'content' => $this->getLayout()->createBlock('customoptions/adminhtml_categoryoptions_edit_tab_categories')->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
