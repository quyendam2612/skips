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
class Emipro_Customoptions_Block_Adminhtml_Customoptions_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId('customoptions_tabs');
				$this->setDestElementId('edit_form');
				$this->setTitle(Mage::helper('customoptions')->__('Custom option manager'));
		}
		protected function _beforeToHtml()
		{ 
			$skulist=$this->getRequest()->getParam("skulist");
				if($skulist!=1)
				{
					$this->addTab('product_grid_section', array(
					'label' => Mage::helper('customoptions')->__('Assign to Product'),
					'title' => Mage::helper('customoptions')->__('Assign to Product'),
					'url'       => $this->getUrl('*/*/products', array('_current' => true)),
					'class'     => 'ajax',
					));	
				}
				else
				{
					$this->addTab('product_sku_section', array(
					'label' => Mage::helper('customoptions')->__('Assign to Product (SKU list)'),
					'title' => Mage::helper('customoptions')->__('Assign to Product (SKU list)'),
					'content' => $this->getLayout()->createBlock('customoptions/adminhtml_customoptions_edit_tab_sku')->toHtml(),
					));
				}
				
				return parent::_beforeToHtml();
		}

}
