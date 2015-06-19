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
class Emipro_Customoptions_Block_Adminhtml_Removecustomoptions_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId('removecustomoptions_tabs');
				$this->setDestElementId('edit_form');
				$this->setTitle(Mage::helper('customoptions')->__('Custom option manager'));
		}
		protected function _beforeToHtml()
		{ 
					$this->addTab('product_sku_remove_section', array(
					'label' => Mage::helper('customoptions')->__('Remove from Product (SKU list)'),
					'title' => Mage::helper('customoptions')->__('Remove from Product (SKU list)'),
					'content' => $this->getLayout()->createBlock('customoptions/adminhtml_removecustomoptions_edit_tab_removesku')->toHtml(),
					));

				
				return parent::_beforeToHtml();
		}

}
