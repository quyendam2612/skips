<?php
class Queen_Skip_Block_Catalog_Product_View_Options_Type_Select
    extends Mage_Catalog_Block_Product_View_Options_Type_Select
{
    public function getPrice($price, $includingTax = null)
    {
        $option = $this->getOption();
        if ($option->getSku()=='permit-type') {
            $price = Mage::helper('tax')->getPrice($this->getProduct(), $price, false);
        }
        elseif (!is_null($includingTax)) {
            $price = Mage::helper('tax')->getPrice($this->getProduct(), $price, true);
        } else {
            $price = Mage::helper('tax')->getPrice($this->getProduct(), $price);
        }
        return $price;
    }
}