<?php
class Queen_Skip_Block_Catalog_Product_View_Options
    extends Mage_Catalog_Block_Product_View_Options
{
    protected function _getPriceConfiguration($option)
    {
        $tmp = Mage::getModel('catalog/product_option')->load($option->getOptionId());
        $data = array();
        $data['price']      = Mage::helper('core')->currency($option->getPrice(true), false, false);
        $data['oldPrice']   = Mage::helper('core')->currency($option->getPrice(false), false, false);
        $data['priceValue'] = $option->getPrice(false);
        $data['type']       = $option->getPriceType();
        $data['excludeTax'] = $price = Mage::helper('tax')->getPrice($option->getProduct(), $data['price'], false);
        if ($tmp->getSku()=='permit-type') {
            $data['includeTax'] = $price = Mage::helper('tax')->getPrice($option->getProduct(), $data['price'], false);
        } else {
            $data['includeTax'] = $price = Mage::helper('tax')->getPrice($option->getProduct(), $data['price'], true);
        }
        return $data;
    }
}