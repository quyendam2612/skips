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
class Emipro_Customoptions_Block_Adminhtml_Customoptions_Grid_Renderer_EditCategory extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {

        $sku = Mage::getModel("catalog/product_option")->load($row->getId())->getData("sku");
        $productUrl = $this->getUrl("*/*/edit", array("id" => $row->getId(), "sku" => $sku));
        $categoryUrl = $this->getUrl("*/*/editcategory", array("id" => $row->getId(), "sku" => $sku));
        return '<a href="' . $categoryUrl . '">' . $this->__('Assign to Category') . '</a>';
    }

}
