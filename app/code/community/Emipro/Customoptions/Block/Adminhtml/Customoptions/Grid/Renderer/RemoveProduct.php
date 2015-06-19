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
class Emipro_Customoptions_Block_Adminhtml_Customoptions_Grid_Renderer_RemoveProduct extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {

        $sku = Mage::getModel("catalog/product_option")->load($row->getId())->getData("sku");
        $productUrl = $this->getUrl("*/*/editsku", array("id" => $row->getId(), "sku" => $sku,"remove"=>1));
        return '<a href="' . $productUrl . '">' . $this->__('Remove From Product (SKU list)') . '</a>';
    }

}
